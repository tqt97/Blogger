<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div
                    class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
                >
                    <p class="_title0">
                        Blogs
                        <Button @click="$router.push('/createBlog')">
                            <Icon type="md-add" />
                            Add blog
                        </Button>
                    </p>
                    <div class="_overflow _table_div">
                        <table class="_table">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Views</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="(blog, i) in blogs" :key="i">
                                <td>{{ blog.id }}</td>
                                <td class="_table_name">{{ blog.title }}</td>
                                <td>
                                    <Tag
                                        color="blue"
                                        v-for="(c, j) in blog.cat"
                                        :key="j"
                                    >
                                        {{ c.categoryName }}
                                    </Tag>
                                </td>
                                <td>
                                    <Tag
                                        color="geekblue"
                                        v-for="(t, y) in blog.tag"
                                        :key="y"
                                    >
                                        {{ t.tagName }}
                                    </Tag>
                                </td>
                                <td>{{ blog.views }}</td>
                                <td>{{ blog.created_at }}</td>
                                <td>
                                    <Button type="info" size="small">
                                        Visit blog
                                    </Button>
                                    <Button
                                        type="info"
                                        size="small"
                                        @click="$router.push(`/updateBlog/${blog.id}`)"
                                        >Edit</Button
                                    >
                                    <Button type="error" size="small" @click="showDeletingModal(blog, i)"  :loading="blog.isDeleting">Delete</Button>
                                </td>
                            </tr>
                            <!-- ITEMS -->
                        </table>
                    </div>
                </div>
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
            blogs: [],
            index: -1,
            showDeleteModal: false,
            isDeleing: false,
            deleteItem: {},
            deletingIndex: -1,
            websiteSettings: [],
            isAdding: false,
        };
    },
    methods: {
        showDeletingModal(blog, i) {
            // console.log("the index is ", i);
            this.deletingIndex = i;
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: "app/delete_blog",
                data: { id: blog.id },
                deletingIndex: i,
                isDeleted: false,
                msg: "Are you sure you want to delete this blog?",
                successMsg: "Blog has been deleted successfully!",
            };
            this.$store.commit("setDeletingModalObj", deleteModalObj);
        },
    },
    async created() {
        const res = await this.callApi("get", "/app/get_blogs");
        if (res.status == 200) {
            this.blogs = res.data;
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
                console.log(this.deletingIndex);
                this.blogs.splice(this.deletingIndex, 1);
            }
        },
    },
};
</script>
