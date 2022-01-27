<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div
                    class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
                >
                    <p class="_title0">
                        Users
                        <Button @click="addModal = true"
                            ><Icon type="md-add" /> Add user</Button
                        >
                    </p>

                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>Email</th>
                                <th>User type</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            <!-- TABLE TITLE -->

                            <!-- ITEMS -->
                            <tr v-for="(user, i) in users" :key="i">
                                <td>{{ user.id }}</td>
                                <td class="_table_name">{{ user.fullName }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.userType }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>
                                    <Button
                                        type="info"
                                        size="small"
                                        @click="showEditModal(user, i)"
                                        >Edit</Button
                                    >
                                    <Button
                                        type="error"
                                        size="small"
                                        @click="showDeletingModal(user, i)"
                                        :loading="user.isDeleting"
                                        >Delete</Button
                                    >
                                </td>
                            </tr>
                            <!-- ITEMS -->
                        </table>
                    </div>
                </div>

                <!-- user adding modal -->
                <Modal
                    v-model="addModal"
                    title="Add user"
                    :mask-closable="false"
                    :closable="false"
                >
                    <div class="space">
                        <Input
                            type="text"
                            v-model="data.fullName"
                            placeholder="Full name"
                        />
                    </div>
                    <div class="space">
                        <Input
                            type="email"
                            v-model="data.email"
                            placeholder="Email"
                        />
                    </div>
                    <div class="space">
                        <Input
                            type="password"
                            v-model="data.password"
                            placeholder="Password"
                        />
                    </div>
                    <div class="space">
                        <Select
                            v-model="data.userType"
                            style="width: 200px"
                            placeholder="Choose user type"
                        >
                            <Option value="admin">ADMIN</Option>
                            <Option value="dev">DEVELOPER</Option>
                            <Option value="editor">EDITOR</Option>
                        </Select>
                    </div>

                    <div slot="footer">
                        <Button type="default" @click="addModal = false"
                            >Close</Button
                        >
                        <Button
                            type="primary"
                            @click="addUser"
                            :disabled="isAdding"
                            :loading="isAdding"
                            >{{ isAdding ? "Adding.." : "Add user" }}</Button
                        >
                    </div>
                </Modal>
                <!-- tag editing modal -->
                <Modal
                    v-model="editModal"
                    title="Edit user"
                    :mask-closable="false"
                    :closable="false"
                >
                    <div class="space">
                        <Input
                            type="text"
                            v-model="editData.fullName"
                            placeholder="Full name"
                        />
                    </div>
                    <div class="space">
                        <Input
                            type="email"
                            v-model="editData.email"
                            placeholder="Email"
                        />
                    </div>
                    <div class="space">
                        <Input
                            type="password"
                            v-model="editData.password"
                            placeholder="Password"
                        />
                    </div>
                    <div class="space">
                        <Select
                            v-model="editData.userType"
                            style="width: 200px"
                            placeholder="Select user type"
                        >
                            <Option value="admin">ADMIN</Option>
                            <Option value="dev">DEVELOPER</Option>
                            <Option value="editor">EDITOR</Option>
                        </Select>
                    </div>

                    <div slot="footer">
                        <Button type="default" @click="editModal = false"
                            >Close</Button
                        >
                        <Button
                            type="primary"
                            @click="editUser"
                            :disabled="isAdding"
                            :loading="isAdding"
                            >{{ isAdding ? "Editing.." : "Edit User" }}</Button
                        >
                    </div>
                </Modal>
                <!-- delete alert modal -->
                <deleteModal></deleteModal>
            </div>
        </div>
    </div>
</template>

<script>
import deleteModal from "../components/deleteModal.vue";
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            data: {
                fullName: "",
                email: "",
                password: "",
                userType: "admin",
            },
            addModal: false,
            editModal: false,
            isAdding: false,
            users: [],
            editData: {
                fullName: "",
                email: "",
                password: "",
                userType: "",
            },
            index: -1,
            showDeleteModal: false,
            isDeleing: false,
            deleteItem: {},
            deletingIndex: -1,
            websiteSettings: [],
        };
    },
    methods: {
        async addUser() {
            const res = await this.callApi(
                "post",
                "app/create_user",
                this.data
            );
            if (res.status === 201) {
                this.users.unshift(res.data);
                this.success("Created user successfully 🎉");
                this.addModal = false;
                this.data.fullName = "";
                this.data.email = "";
                this.data.password = "";
            } else {
                if (res.status == 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.error("Something went wrong !");
                }
            }
        },
        async editUser() {
            const res = await this.callApi(
                "post",
                "app/edit_user",
                this.editData
            );
            if (res.status === 200) {
                this.users[this.index].fullName = this.editData.fullName;
                this.users[this.index].email = this.editData.email;
                this.users[this.index].password = this.editData.password;
                this.users[this.index].userType = this.editData.userType;
                // this.users[this.index] = this.editData;
                this.success("User has been edited successfully!");
                this.editModal = false;
            } else {
                if (res.status == 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.error();
                }
            }
        },
        showEditModal(user, index) {
            let obj = {
                id: user.id,
                fullName: user.fullName,
                email: user.email,
                password: user.password,
                userType: user.userType,
            };
            this.editData = obj;
            this.editModal = true;
            this.index = index;
        },
        showDeletingModal(user, i) {
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: "app/delete_user",
                data: user,
                deletingIndex: i,
                isDeleted: false,
            };
            this.$store.commit("setDeletingModalObj", deleteModalObj);
        },
    },
    async created() {
        const res = await this.callApi("get", "app/get_users");
        if (res.status == 200) {
            this.users = res.data;
        } else {
            this.error();
        }
    },
    components: {
        deleteModal,
    },
    computed: {
        ...mapGetters(["getDeleteModalObj"]),
    },
    watch: {
        getDeleteModalObj(obj) {
            if (obj.isDeleted) {
                this.users.splice(obj.deletingIndex, 1);
            }
        },
    },
};
</script>
