<template>
    <div>
        <div v-if="user_id == advert.user_id">
            <el-button type="warning" round style="float:right;margin-right: 50px" @click="deleteAdvert">Delete
            </el-button>
            <el-button type="success" round style="float:right;margin-right: 20px" @click="editAdvert(advert.id)">
                Edit
            </el-button>
        </div>
        <div>
    <h3 align="center" style="margin-top:40px">{{advert.title}}</h3>
            <p>Date create: {{advert.created_at}}</p>
            <p>Author: {{advert.users.login}}</p>
        </div>
        <div>
            <img :src="advert.photo" alt="">
        </div>
        <div style="margin-top: 40px">
            <h4>Description</h4>
            {{advert.description}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "one-advert",
        props: {
            result: {
                type: Object,
                default: {}
            },
        },
        data() {
            return {
                advert:{},
                user_id: null,
            };
        },
        created() {
            this.advert = this.result.advert;
            if (this.result.user != null)
            {
                this.user_id = this.result.user.id;
                this.$store.dispatch('set_login_status',true);
                this.$store.dispatch('set_username',this.result.user.login);
            }
        },
        methods: {
            deleteAdvert() {
                axios.post('/delete_advert',
                    {'id': this.advert.id})
                    .then(response => {
                        if (response.status == 200) {
                            window.location.href = "/";
                        }
                    }).catch(error => {
                    this.$message({
                        showClose: true,
                        message: "Упс, ошибка!!! Попробуйте еще раз",
                        type: 'error'
                    });
                });
            },
            editAdvert(id) {
                window.location.href = "/edit/"+id;
            }
        },
    }
</script>

<style scoped>

</style>
