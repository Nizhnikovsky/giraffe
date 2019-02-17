<template>
    <div>
        <el-menu
            :default-active="activeIndex"
            class="el-menu-demo"
            mode="horizontal"
            @select="handleSelect"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b">
            <img src="/img/menu/1509622.png" alt=""
                 style="width: 50px;height: 50px;float:left;margin-top:5px;margin-left:30px;margin-right: 50px">
            <el-menu-item index="1"><a href="/" style="text-decoration: none">Adverts</a></el-menu-item>
            <el-menu-item index="2">Info</el-menu-item>
            <div v-if="!this.$store.getters.is_logined">
                <el-menu-item index="3" style="float: right;margin-right:30px" @click="Login">Login</el-menu-item>
            </div>
            <div v-else>
                <el-menu-item index="4" style="float: right;margin-right:30px" @click="Logout">Logout
                </el-menu-item>
                <el-menu-item index="5" style="float: right;margin-right:10px">
                    {{this.$store.getters.username}}
                </el-menu-item>
                    <el-button type="success" round style="float: right;margin-right:10px;margin-top:10px;" @click="toCreate">Create Ad</el-button>
            </div>
        </el-menu>
    </div>
</template>

<script>
    export default {
        name: 'main-page',
        data() {
            return {
                activeIndex: '1',
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            Logout() {
                axios.get('/logout')
                    .then(response => {
                        //console.log(response);
                        if (response.status == 200) {
                            this.$store.dispatch('set_login_status', false);
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
            Login() {
                window.location.href = "/login";
            },
            toCreate(){
                window.location.href = "/edit";
            }
        },
        mounted() {
            //console.log(this.$store.getters.is_logined);
        }
    }
</script>
