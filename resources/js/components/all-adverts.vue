<template>
    <div>
        <el-row>
            <el-col :span="24" style="margin-top: 40px">
                <div><h2 align="center">Все объявления</h2></div>
            </el-col>
        </el-row>
        <el-row style="margin-left: 150px;margin-top:30px">
            <el-col :span="4" v-for="(advert, index) in adverts" :key="index" style="margin-right: 35px">
                <el-card :body-style="{ padding: '0px' }">
                    <img :src="advert.photo" class="image">
                    <div style="padding: 20px;">
                        <span><a :href="'/advert/'+advert.id">{{advert.title}}</a></span>
                        <span><p>{{advert.users.login}}</p></span>
                        <div class="bottom clearfix">
                            <time class="time">{{ advert.created_at }}</time>
                        </div>
                        <div v-if="user_id == advert.user_id">
                            <el-button type="warning" round style="margin-left: 10px" @click="deleteAdvert(advert.id)">Delete
                            </el-button>
                            <el-button type="success" round style="margin-left: 10px" @click="editAdvert(advert.id)">
                                Edit
                            </el-button>
                        </div>
                    </div>
                </el-card>
            </el-col>
        </el-row>
        <div style="margin-top:40px;margin-left:770px">
            <el-pagination
                background
                layout="prev, pager, next"
                @current-change="handleCurrentChange"
                :total="pages*10">
            </el-pagination>
        </div>

    </div>
</template>

<script>
    export default {
        name: "all-adverts",
        props: {
            result: {
                type: Object,
                default: {}
            },
        },
        data() {
            return {
                adverts: [],
                user_id: null,
                pages: null,
            };
        },
        created() {
            this.adverts = this.result.adverts;
            console.log(this.adverts);
            this.pages = this.result.pages;
            if (this.result.user != null) {
                this.user_id = this.result.user.id;
                this.$store.dispatch('set_login_status', true);
                this.$store.dispatch('set_username', this.result.user.login);
            }
        },
        methods: {
            handleCurrentChange(val) {
                axios.post('/paginate',
                    {'offset': val})
                    .then(response => {
                        if (response.status == 200) {
                            this.adverts = response.data.adverts;
                            this.pages = response.data.pages;
                        }
                    }).catch(error => {
                    this.$message({
                        showClose: true,
                        message: "Упс, ошибка!!! Попробуйте еще раз",
                        type: 'error'
                    });
                });
            },
            deleteAdvert(id) {
                axios.post('/delete_advert',
                    {'id': id})
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
