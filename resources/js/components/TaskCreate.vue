<template id="task-create">

    <div>
        <h3>Создание новой задачи</h3>
        <form v-on:submit.prevent="createTask">
            <div class="form-group">
                <label for="create-title">Название</label>
                <input type="text" v-model="task.title" class="form-control" id="create-title" placeholder="Введите название задачи" required>
            </div>
            <div class="form-group">
                <label for="create-description">Описание</label>
                <textarea v-model="task.description" class="form-control" id="create-description" rows="10" placeholder="Введите описания задачи"></textarea>
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
        }        ,
        methods: {
            createTask: function () {
                let uri = 'http://to-do-list/api/tasks';
                Axios.post(uri, this.task)
                    .then((response) => {
                        this.$router.push({name: 'TaskList'})
                    })
            }
        }
    }

</script>

