<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div
                    class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
                >
                    <p class="_title0">Create blog</p>
                    <div class="_input_field">
                        <Input
                            type="text"
                            v-model="data.title"
                            placeholder="Title"
                        />
                    </div>
                    <div class="_overflow _table_div blog_editor">
                        <editor
                            ref="editor"
                            holder-id="codex-editor"
                            save-button-id="save-button"
                            :init-data="initData"
                            @save="onSave"
                            :config="config"
                        />
                    </div>
                    <div class="_input_field">
                        <Input
                            type="textarea"
                            v-model="data.post_excerpt"
                            :rows="4"
                            placeholder="Post excerpt "
                        />
                    </div>
                    <div class="_input_field">
                        <Select
                            filterable
                            multiple
                            placeholder="Select category"
                            v-model="data.category_id"
                        >
                            <Option
                                v-for="(c, i) in category"
                                :value="c.id"
                                :key="i"
                                >{{ c.categoryName }}</Option
                            >
                        </Select>
                    </div>
                    <div class="_input_field">
                        <Select
                            filterable
                            multiple
                            placeholder="Select tag"
                            v-model="data.tag_id"
                        >
                            <Option
                                v-for="(t, i) in tag"
                                :value="t.id"
                                :key="i"
                                >{{ t.tagName }}</Option
                            >
                        </Select>
                    </div>
                    <div class="_input_field">
                        <Input
                            type="textarea"
                            v-model="data.metaDescription"
                            :rows="4"
                            placeholder="Meta description"
                        />
                    </div>
                    <div class="_input_field">
                        <Button
                            @click="save"
                            :loading="isCreating"
                            :disabled="isCreating"
                            >{{
                                isCreating ? "Please wait..." : "Create blog"
                            }}</Button
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ImageTool from "@editorjs/image";
export default {
    data() {
        return {
            config: {
                class: ImageTool,
                image: {
                    field: "image",
                    types: "image/*",
                },
            },
            initData: null,
            data: {
                title: "",
                post: "",
                post_excerpt: "",
                metaDescription: "",
                category_id: [],
                tag_id: [],
                jsonData: null,
            },
            articleHTML: "",
            category: [],
            tag: [],
            isCreating: false,
        };
    },
    methods: {
        async onSave(response) {
            // console.log("response onSave fn", response);
            var data = response;
            await this.outputHtml(data.blocks);
            this.data.post = this.articleHTML;
            this.data.jsonData = JSON.stringify(data);
            this.isCreating = true;
            const res = await this.callApi(
                "post",
                "app/create_blog",
                this.data
            );
            if (res.status === 200) {
                this.success("Blog created successfully🎉🎉🎉");
                this.$router.push('/blogs');
            } else {
                this.error();
            }
            this.isCreating = false;
            for (let i in this.data) {
                this.data[i] = "";
            }
            // this.data.jsonData = '';
            // console.log(this.$refs.editor._data.state.editor);
        },
        async save() {
            this.$refs.editor.save();
            // await this.$refs.editor._data.state.editor.save();
        },
        outputHtml(articleObj) {
            articleObj.map((obj) => {
                switch (obj.type) {
                    case "paragraph":
                        this.articleHTML += this.makeParagraph(obj);
                        break;
                    case "image":
                        this.articleHTML += this.makeImage(obj);
                        break;
                    case "header":
                        this.articleHTML += this.makeHeader(obj);
                        break;
                    case "raw":
                        this.articleHTML += `<div class="ce-block">
					<div class="ce-block__content">
					<div class="ce-code">
						<code>${obj.data.html}</code>
					</div>
					</div>
				</div>\n`;
                        break;
                    case "code":
                        this.articleHTML += this.makeCode(obj);
                        break;
                    case "list":
                        this.articleHTML += this.makeList(obj);
                        break;
                    case "quote":
                        this.articleHTML += this.makeQuote(obj);
                        break;
                    case "warning":
                        this.articleHTML += this.makeWarning(obj);
                        break;
                    case "checklist":
                        this.articleHTML += this.makeChecklist(obj);
                        break;
                    case "embed":
                        this.articleHTML += this.makeEmbed(obj);
                        break;

                    case "delimeter":
                        this.articleHTML += this.makeDelimeter(obj);
                        break;
                    default:
                        return "";
                }
            });
        },
    },
    async created() {
        const [cat, tag] = await Promise.all([
            this.callApi("get", "/app/get_categories"),
            this.callApi("get", "/app/get_tags"),
        ]);
        if (cat.status == 200) {
            this.category = cat.data;
            this.tag = tag.data;
        } else {
            this.console.error();
        }
    },
};
</script>

<style>
.blog_editor {
    margin-left: 160px;
    padding: 4px 7px;
    font-size: 14px;
    border: 1px solid #dcdee2;
    border-radius: 4px;
    color: #515a6e;
    background-color: #fff;
    background-image: none;
    z-index: -1;
}
.blog_editor:hover {
    border: 1px solid #57a3f3;
}
._input_field {
    margin: 20px 0 20px 160px;
}
.ce-block__content {
    max-width: 92% !important;
}
.ce-toolbar__content {
    max-width: 95% !important;
}
.ce-toolbar .ce-toolbox,
.ce-toolbar__plus {
    background-color: #f3f5fa !important;
}
</style>
