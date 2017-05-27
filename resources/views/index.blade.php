<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>vue</title>
</head>
<body>
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div id="app">
    <table width="500" border="1" class="table table-striped">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>年龄</th>
            <th>操作</th>
        </tr>
        <tr v-for="(user,index) in users">
            <td>@{{user.id}}</td>
            <td>@{{user.name }}</td>
            <td>@{{user.email }}</td>
            <td>@{{user.age}}</td>
            <td>
                <button @click="del(index,user.id)"  class="btn btn-danger">删除</button>
                <button @click="edit(index,user)"  class="btn btn-info">编辑</button>

            </td>
        </tr>
    
       
        用户名：<input type="text" v-model="addUser.name">
        邮箱：<input type="text" v-model="addUser.email">
        年龄：<input type="text" v-model="addUser.age">
        密码：<input type="password" v-model="addUser.password">

        <button @click="add()"  class="btn btn-primary">添加</button>
        <br>
        用户名：<input type="text" v-model="editUser.name">
        邮箱：<input type="text" v-model="editUser.email">
        年龄：<input type="text" v-model="editUser.age">
        密码：<input type="password" v-model="editUser.password">
        <button @click="update()" class="btn btn-success">修改</button>
        <br>
        <br>
    </table>
</div>
</body>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            users: '',
            message:"xuyuling",
            addUser:{
                id:'',
                name:'',
                email:'',
                age:'',
                password:''
            },
            editUser:{
                id:'',
                name:'',
                email:'',
                age:'',
                password:''
            },
            userIndex:''
        },
        mounted: function () {
            axios.get('http://vue.com/api/user')
                .then(function (response) {
                    this.users = response.data;
                }.bind(this))
                .catch(function (error) {
                    console.log(error);
                });
        },
        methods:{
            del:function (index,id) {
                axios.delete('http://vue.com/api/user/'+id)
                        .then(function (response) {
                            this.users.splice(index,1);
                        }.bind(this));
            },
            edit:function (index,user) {
                this.editUser.name = user.name;
                this.editUser.email = user.email;
                this.editUser.age = user.age;
                this.editUser.password = user.password;
                this.editUser.id = user.id;
                this.userIndex = index;
            },
            update:function () {
                // console.log('xxxxx');return false;
                axios.patch('http://vue.com/api/user',this.editUser)
                        .then(function (response) {
                            var result = response.data;
                            if(result.status == 200){
                                this.users[this.userIndex].name = this.editUser.name;
                                this.users[this.userIndex].email = this.editUser.email;
                                this.users[this.userIndex].age = this.editUser.age;
                            }else{
                                 console.log(error);
                            }
                        }.bind(this));




                // axios.patch('http://vue.com/api/user/',this.editUser)
                //         .then(function (response) {
                //             var result = response.data;
                //             if(result.status == 200){

                //             }else{
                //                  console.log(error);
                //             }

                //         }.bind(this));
            },
            add:function () {
                axios.post('http://vue.com/api/user',this.addUser)
                        .then(function (response) {
                            var result = response.data;
                            this.addUser.id = result.data.id;
                            this.users.push(this.addUser);
                        }.bind(this));
            }
        }
    });
</script>
</html>