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
        warning (desc, title = 'Warning') {
            this.$Notice.warning({
                title: title,
                desc: desc ? desc : ''
            });
        },
        error (desc='Oops, something went wrong !', title = 'Error') {
            this.$Notice.error({
                title: title,
                desc: desc ? desc : ''
            });
        }
    }
};
