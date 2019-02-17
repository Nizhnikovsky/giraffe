<template>
    <div>
        <el-row>
            <el-col :span="24" style="margin-top: 60px">
                <div><h2 align="center">Редактирование объявления</h2></div>
            </el-col>
        </el-row>
        <el-row :gutter="20" style="margin-top: 80px">
            <el-col :span="12" :offset="6">
                <el-form ref="form" :model="form" :rules="rules" label-width="120px">
                    <el-form-item label="Title">
                        <el-input v-model="form.title" :value="form.title"></el-input>
                    </el-form-item>
                    <el-form-item label="Description">
                        <el-input type="textarea" :rows="10" v-model="form.description"
                                  :value="form.description"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit('form')">Save</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: "edit-advert",
        props: {
            result: {
                type: Object,
                default: {}
            },
        },
        data() {
            return {
                form: {
                    title: '',
                    description: ''
                },
                rules: {
                    title: [
                        {required: true, message: 'Please input title', trigger: 'blur'}
                    ],
                    description: [
                        {required: true, message: 'Please input description', trigger: 'blur'}
                    ],
                }
            };
        },
        created() {
            this.form = this.result.advert;
            if (this.result.user != null) {
                this.$store.dispatch('set_login_status', true);
                this.$store.dispatch('set_username', this.result.user.login);
            }
        },
        methods: {
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.post('/save_after_edit',
                            this.form)
                            .then(response => {
                                if (response.status == 200) {
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
