<template>
<div>
    <div class="container" style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <el-form :model="ruleForm" status-icon :rules="rules" ref="ruleForm" label-width="150px" class="demo-ruleForm" style="width: 80%;margin-top: 50px">
                        <el-form-item label="Login" prop="login">
                            <el-input type="text" v-model="ruleForm.login" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Password" prop="password">
                            <el-input type="password" v-model="ruleForm.password" autocomplete="off"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="submitForm('ruleForm')" style="margin-left: 180px">Submit</el-button>
                        </el-form-item>
                    </el-form>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "login-page",
        data() {
            var validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('Please input the password'));
                } else {
                    // if (this.ruleForm2.checkPass !== '') {
                    //     this.$refs.ruleForm2.validateField('checkPass');
                    // }
                    callback();
                }
            };
            return {
                ruleForm: {
                    password: '',
                    login: '',
                },
                rules: {
                    login: [
                        { required: true, message: 'Please input login', trigger: 'blur' }
                    ],
                    password: [
                        { validator: validatePass, trigger: 'blur' }
                    ],
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.post('/login',
                            this.ruleForm)
                            .then(response => {
                                if (response.status == 200) {
                                    this.$store.dispatch('set_login_status',true);
                                    window.location.href = "/";
                                } else {
                                    this.$message({
                                        showClose: true,
                                        message: response.data.message,
                                        type: 'error'
                                    });
                                }
                            }).catch(error => {
                            this.$message({
                                showClose: true,
                                message: error,
                                type: 'error'
                            });
                        });
                    } else {
                        this.$message({
                            showClose: true,
                            message: "Упс, ошибка!!! Проверьте данные",
                            type: 'error'
                        });
                        return false;
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>
