<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div
                    class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
                >
                    <p class="_title0">
                        Permissions
                        <Select
                            v-model="data.id"
                            style="width: 30%; margin-left: 15px"
                            placeholder="Select admin type"
                            @on-change="changeAdmin"
                        >
                            <Option
                                :value="r.id"
                                v-for="(r, i) in roles"
                                :key="i"
                                >{{ r.roleName }}</Option
                            >
                        </Select>
                    </p>
                    <div class="_overflow _table_div">
                        <table class="_table">
                            <tr>
                                <th>Resource name</th>
                                <th>Create</th>
                                <th>Read</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            <tr v-for="(r, i) in resources" :key="i">
                                <td class="_table_name">
                                    {{ r.resourceName }}
                                </td>
                                <td>
                                    <Checkbox v-model="r.create"></Checkbox>
                                </td>
                                <td><Checkbox v-model="r.read"></Checkbox></td>
                                <td>
                                    <Checkbox v-model="r.update"></Checkbox>
                                </td>
                                <td>
                                    <Checkbox v-model="r.delete"></Checkbox>
                                </td>
                            </tr>
                            <!-- <tr> -->
                            <td colspan="5" style="text-align: center">
                                <Button
                                    type="primary"
                                    :style="{ marginTop: '10px' }"
                                    :loading="isSubmit"
                                    :disabled="isSubmit"
                                    @click="assignRole"
                                >
                                    {{ isSubmit ? "Submitting..." : "Submit" }}
                                </Button>
                            </td>
                            <!-- </tr> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: {
                roleName: "",
                id: null,
            },
            isSubmit: false,
            roles: [],
            resources: [
                {
                    resourceName: "Home", create: false, read: false, update: false, delete: false, name: "/", icon: "ios-podium",
                },
                {
                    resourceName: "Tags", create: false, read: false, update: false, delete: false, name: "tags", icon: "ios-pricetags",
                },
                {
                    resourceName: "Categories",
                    create: false, read: false, update: false, delete: false, name: "categories", icon: "ios-list-box",
                },
                {
                    resourceName: "Create Blog" ,create: false ,read: false ,update: false ,delete: false,
                    name: "createBlog" ,icon: "ios-list-box",
                },
                {
                    resourceName: "Blogs" ,create: false, read: false ,update: false,
                    delete: false ,name: "blogs" ,icon: "ios-list-box",
                },
                {
                    resourceName: "Users",
                    create: false ,read: false ,update: false,
                    delete: false ,name: "users" ,icon: "ios-people",
                },
                {
                    resourceName: "Roles" ,create: false ,read: false ,update: false ,delete: false ,
                    name: "roles" ,icon: "md-git-network",
                },
                {
                    resourceName: "Permissions" ,create: false, read: false ,update: false,
                    delete: false ,name: "permissions" ,icon: "md-options",
                },
            ],
            defaultResourcesPermission: [
                {
                    resourceName: "Home" ,create: false, read: false ,update: false,
                    delete: false ,name: "/" ,icon: "ios-podium",
                },
                {
                    resourceName: "Tags" ,create: false, read: false ,update: false,
                    delete: false ,name: "tags" ,icon: "ios-pricetags",
                },
                {
                    resourceName: "Categories" ,create: false, read: false ,update: false ,delete: false,
                    name: "categories" ,icon: "ios-list-box",
                },
                {
                    resourceName: "Create blog" ,create: false, read: false ,update: false,
                    delete: false ,name: "createBlog" ,icon: "ios-list-box",
                },
                {
                    resourceName: "Blogs" ,create: false, read: false ,update: false,
                    delete: false ,name: "blogs" ,icon: "ios-list-box",
                },
                {
                    resourceName: "Users",  create: false,
                    read: false,  update: false, delete: false,   name: "users", icon: "ios-people",
                },
                {
                    resourceName: "Roles",  create: false,
                    read: false, update: false,
                    delete: false,  name: "roles",  icon: "md-git-network",
                },
                {
                    resourceName: "Permissions",create: false,
                    read: false,    update: false, delete: false,
                    name: "permissions",                    icon: "md-options",
                },
            ],
        };
    },
    methods: {
        async assignRole() {
            let data = JSON.stringify(this.resources);
            const res = await this.callApi("post", "app/permissions", {
                permission: data,
                id: this.data.id,
            });
            if (res.status === 200) {
                this.success("Role has been assign successfully 🎉🎉🎉");
                let index = this.roles.findIndex(
                    (role) => role.id == this.data.id
                );
                this.roles[index].permission = data;
            } else {
                this.error();
            }
        },
        changeAdmin() {
            let index = this.roles.findIndex((role) => role.id == this.data.id);
            let permission = this.roles[index].permission;
            if (!permission) {
                this.resources = this.defaultResourcesPermission;
            } else {
                this.resources = JSON.parse(permission);
            }
        },
    },
    async created() {
        const res = await this.callApi("get", "app/get_roles");
        if (res.status == 200) {
            this.roles = res.data;
            if (res.data.length) {
                this.data.id = res.data[0].id;
                if (res.data[0].permission) {
                    this.resources = JSON.parse(res.data[0].permission);
                }
            }
        } else {
            this.error();
        }
    },
};
</script>
