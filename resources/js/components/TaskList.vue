<template id="task-list">
    <div class="row">
        <section>
            <router-link class="btn btn-xs btn-primary" v-bind:to="{path: '/task-create_edit'}">
                <span class="glyphicon glyphicon-plus"></span>
                Создать новую задачу
            </router-link>
        </section>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th class="col-md-2">Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(task, index) in tasks.data"> <!-- filteredTasks -->
                    <td>{{ index + 1 }}</td>
                    <td>{{ task.title }}</td>
                    <td>{{ task.description }}</td>
                    <td>
                        <router-link class="btn btn-info btn-sm" v-bind:to="{name: 'TaskShow', params: {id: task.id}}">Подробнее</router-link>
                        <router-link class="btn btn-warning btn-sm" v-bind:to="{name: 'TaskCreateEdit', params: {id: task.id}}">Редактировать</router-link>
                        <button type="submit" @click.prevent="deleteTask(task.id)" class="btn btn-danger btn-sm">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination :data="tasks" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    import pagination from 'laravel-vue-pagination';


    export default {

        components: {
            pagination
        },

        data() {
            return {
                tasks: {},
            };
        },
        created() {
            let uri = 'http://to-do-list/api/tasks';
            Axios.get(uri)
                .then((response) =>{
                    this.tasks = response.data;
                });
        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                Axios.get('http://to-do-list/api/tasks?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            },
            deleteTask(id) {
                if (confirm('Вы уверены что хотите удалить эту задачу?')){
                    Axios.delete('http://to-do-list/api/tasks/' + id)
                        .then((response) => {
                            this.getResults();
                        });
                }
            },
        },
    }
</script>

