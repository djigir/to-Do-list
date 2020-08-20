<template id="task-edit">

    <div>
        <h3>Редактирование <strong>{{ task.title }}</strong></h3>
        <form v-on:submit.prevent="updateTask">
            <div class="form-group">
                <label for="edit-title">Название</label>
                <input type="text" v-model="task.title" class="form-control" id="edit-title" placeholder="Введите название задачи" required>
            </div>
            <div class="form-group">
                <label for="edit-description">Описание</label>
                <textarea v-model="task.description" class="form-control" id="edit-description" rows="10" placeholder="Введите описания задачи"></textarea>
                <small class="help-block">Это поле не являеться обязательным</small>
            </div>
            <button type="submit" class="btn btn-success">Создать задачу</button>
            <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Назад</router-link>
        </form>

    </div>
</template>


<script>

    export default {
        data() {
            return {
                task: {
                    title: '',
                    description: ''
                }
            }
        },
        created() {
            let uri = 'http://to-do-list/api/tasks/'+this.$route.params.id+'/edit';
            Axios.get(uri)
                .then((response) => {
                    this.task = response.data;
                });
        },
        methods: {
            updateTask() {
                let uri = 'http://to-do-list/api/tasks/'+this.$route.params.id;
                Axios.patch(uri, this.task)
                    .then((response) =>{
                        this.$router.push({name: 'TaskList'});
                    });
            }
        }
    }

</script>

