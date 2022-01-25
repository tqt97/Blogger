<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div
                    class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
                >
                    <p class="_title0">
                        Tags

                        <Button @click="addModal = true">
                            <Icon type="ios-add" />Add Tag
                        </Button>
                    </p>

                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>ID</th>
                                <th>Tag name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            <!-- TABLE TITLE -->

                            <!-- ITEMS -->
                            <tr v-for="(tag, i) in tags" :key="i">
                                <td>{{ tag.id }}</td>
                                <td class="_table_name">{{ tag.tagName }}</td>
                                <td>{{ tag.created_at }}</td>
                                <td>
                                    <Button
                                        type="info"
                                        size="small"
                                        @click="showEditModal(tag, i)"
                                    >
                                        Edit</Button
                                    >
                                    <Button
                                        type="error"
                                        size="small"
                                        @click="showDeletingModal(tag, i)"
                                        :loading="tag.isDeleting"
                                        >Delete</Button
                                    >
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <Page :total="5" />
                <!-- Modal add tags -->
                <Modal
                    v-model="addModal"
                    title="Add tag"
                    :mask-closable="false"
                >
                    <Input
                        v-model="data.tagName"
                        placeholder="Fill tag name"
                        style="width: 100%"
                    />

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">
                            Close
                        </Button>
                        <Button
                            type="primary"
                            @click="addTag"
                            :disabled="isAdding"
                            :loading="isAdding"
                        >
                            {{ isAdding ? "Adding..." : "Add tag" }}
                        </Button>
                    </div>
                </Modal>
                <!-- Modal edit tags -->
                <Modal
                    v-model="editModal"
                    title="Edit tag"
                    :mask-closable="false"
                >
                    <Input
                        v-model="editData.tagName"
                        placeholder="Fill tag name"
                        style="width: 100%"
                    />

                    <div slot="footer">
                        <Button type="default" @click="editModal = false">
                            Close
                        </Button>
                        <Button
                            type="primary"
                            @click="editTag"
                            :disabled="isEdit"
                            :loading="isEdit"
                        >
                            {{ isEdit ? "Updating..." : "Update tag" }}
                        </Button>
                    </div>
                </Modal>
                <!-- Delete confirm modal-->
                <Modal v-model="showDeleteModal" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>Are you sure you want to delete this item ?</p>
                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long :loading="isDeleting" :disabled="isDeleting" @click="deleteTag">Delete</Button>
                    </div>
                </Modal>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: {
                tagName: "",
            },
            addModal: false,
            isAdding: false,
            tags: [],
            editModal: false,
            isEdit: false,
            editData: {
                tagName: "",
            },
            index: -1,
            showDeleteModal: false,
            isDeleting: false,
            deleteItem: {},
            deletingIndex: -1,
        };
    },
    methods: {
        async addTag() {
            // if (this.data.tagName.trim() === "")
            //     this.error("Tag name is required");
            const res = await this.callApi("post", "app/create_tag", this.data);
            if (res.status === 201) {
                this.tags.unshift(res.data);
                this.success("Add tag successfully 🎉🎉🎉");
                this.addModal = false;
                this.data.tagName = "";
            } else {
                if (res.status === 422) {
                    if (res.data.errors.tagName[0])
                        this.warning(res.data.errors.tagName[0]);
                } else {
                    this.error("Oops, Something went wrong 💥💥💥");
                }
            }
        },
        async editTag() {
            // if (this.data.tagName.trim() === "")
            //     this.error("Tag name is required");
            this.tags[this.index].tagName = this.editData.tagName;
            const res = await this.callApi(
                "post",
                "app/edit_tag",
                this.editData
            );
            if (res.status === 200) {
                this.success("Tag name has been edit successfully 🎉🎉🎉");
                this.editModal = false;
            } else {
                if (res.status === 422) {
                    if (res.data.errors.tagName[0])
                        this.warning(res.data.errors.tagName[0]);
                } else {
                    this.error("Oops, Something went wrong 💥💥💥");
                }
            }
        },
        showEditModal(tag, index) {
            // let obj = {
            //     id: tag.id,
            //     tagName: tag.tagName,
            // }
            // this.editData = obj;
            this.editData = tag;
            this.editModal = true;
            this.index = index;
        },
        async deleteTag() {
            this.isDeleting = true;
            const res = await this.callApi( "post","app/delete_tag",this.deleteItem);
            if (res.status === 200) {
                this.tags.splice(this.deletingIndex, 1);
                this.success("Tag has been deleted successfully 🎉🎉🎉");
            } else {
                this.error("Oops, something went wrong 💥💥💥");
            }
            this.isDeleting = false;
            this.showDeleteModal = false;
        },
        showDeletingModal(tag, i) {
            this.showDeleteModal = true;
            this.deleteItem = tag;
            this.deletingIndex = i;
        },
    },
    async created() {
        const res = await this.callApi("get", "app/get_tags");
        if (res.status == 200) {
            this.tags = res.data;
        } else {
            this.error("Oops, Something went wrong 💥💥💥");
        }
    },
};
</script>
