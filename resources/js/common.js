import {mapGetters} from 'vuex';

export default {
    methods: {
        async callApi (method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
            } catch (e) {
                return e.response;
            }
        },
        info (desc, title = 'Info') {
            this.$Notice.info({
                title: title,
                desc: desc ? desc : ''
            });
        },
        success (desc, title = 'Success') {
            this.$Notice.success({
                title: title,
                desc: desc ? desc : ''
            });
        },
        warning2 (desc, title = 'Warning') {
            this.$Notice.warning({
                title: title,
                desc: desc ? desc : ''
            });
        },
        error (desc = 'Oops, something went wrong !', title = 'Error') {
            this.$Notice.error({
                title: title,
                desc: desc ? desc : ''
            });
        },
        checkUserPermission (key) {
            if (!this.userPermission) return true;
            let isPermitted = false;
            for (let d of this.userPermission) {
                if (this.$route.name === d.name) {
                    if (d[ key ]) {
                        isPermitted = true;
                        break;
                    } else {break;}
                }
            }
            return isPermitted;
        }
    },
    computed: {

        ...mapGetters({
            'userPermission': 'getUserPermission'
        }),
        isCreatePermitted () {
            return this.checkUserPermission('create');
        },
        isReadPermitted () {
            return this.checkUserPermission('read');
        },
        isUpdatePermitted () {
            return this.checkUserPermission('update');
        },
        isDeletePermitted () {
            return this.checkUserPermission('delete');
        }
    }
};
