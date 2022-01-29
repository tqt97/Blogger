<template>
    <div class="container">
        <div class="_box_shadow _border_radious _p20 centered">
            <h1 class="title__header">Sign In</h1>

            <div class="form-group">
                <label>Email address</label>
                <input
                    type="email"
                    v-model="data.email"
                    name="email"
                    class="form-control form-control-lg"
                    autocomplete="false"
                />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    v-model="data.password"
                    class="form-control form-control-lg"
                    autocomplete="false"
                />
            </div>
            <div class="form-group center">
                <button
                    type="submit"
                    class="btn btn-submit btn-lg"
                    @click="login"
                    :disabled="isLogging"
                    :loading="isLogging"
                >
                    {{ isLogging ? "Sing in....." : "Sign in" }}
                </button>
            </div>
        </div>
    </div>
</template>
<style scoped>
.center {
    text-align: center;
}
label {
    font-weight: 500;
    font-size: 1.2rem;
}
.centered {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30rem;
}
.title__header {
    color: #0099ff;
    text-align: center;
    margin-bottom: 10px;
    font-size: 2.5rem;
}
.btn-submit {
    font-size: 1rem;
    background-color: #0099ff;
    color: #fff;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
}
.btn-submit:hover {
    -webkit-transform: translateY(-3px);
    transform: translateY(-3px);
    -webkit-box-shadow: 0 1rem 2rem rgb(0 0 0 / 15%);
    box-shadow: 0 1rem 2rem rgb(0 0 0 / 15%);
}
</style>
<script>
export default {
    data() {
        return {
            data: {
                email: "",
                password: "",
            },
            isLogging: false,
        };
    },
    methods: {
        async login() {
            const res = await this.callApi(
                "post",
                "app/admin_login",
                this.data
            );
            this.isLogging = true;
            if (res.status === 200) {
                window.location = "/";
                this.success(res.data.msg);
            } else {
                if (res.status === 401) {
                    this.info(res.data.msg);
                } else if (res.status === 422) {
                    for (let i in res.data.errors) {
                        this.error(res.data.errors[i][0]);
                    }
                } else {
                    this.error();
                }
            }
            this.isLogging = false;
        },
    },
};
</script>
