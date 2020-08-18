<template>

    <div>
        <h2>Задачи</h2>
        <form @submit.prevent="addTask" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Название" v-model="task.title">
            </div>
            <div class="form-group">
                <textarea type="text" class="form-control" placeholder="Описание" v-model="task.description"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>


        <div class="card card-body mb-2" v-for="task in tasks" v-bind:key="task.id">
            <h3>{{ task.title }}</h3>
            <p>{{ task.description }}</p>
            <hr>
            <button @click.prevent="editTask(task)" class="btn btn-warning mb-3">Редактировать</button>
            <button @click="deleteTask(task.id)" class="btn btn-danger">Удалить</button>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                task: {
                    id: '',
                    title: '',
                    description: ''
                },
                task_id : '',
                //edit
                edit: false
            }
        },
        mounted() {
            axios.get('api/tasks')
                .then(response => (this.tasks = response.data.data));
        },

        methods: {

            deleteTask(id, index) {
                if (confirm('Вы действительно хотите удалить запись?')){
                    axios.delete(`api/task/${id}`)
                        .then(response => {
                            this.tasks.splice(index, 1).push(response.data.data);
                        });
                }
            },
            addTask(index) {
                if (this.edit === false) {
                    axios.post('api/task', {
                        title: this.task.title,
                        description: this.task.description,
                    })
                        .then(response => {
                            this.task.title = '';
                            this.task.description = '';
                            this.tasks.push(response.data.data);
                        });
                } else {
                    axios.put('api/task', {
                        task_id: this.task.id,
                        title: this.task.title,
                        description: this.task.description,
                    })
                        .then(response => {
                            console.log(response);
                            this.task.title = '';
                            this.task.description = '';
                            this.tasks.splice(index, 1).push(response.data.data);
                        });
                }
            },
            editTask(task) {
                this.edit = true;
                this.task.id = task.id;
                this.task_id = task.id;
                this.task.title = task.title;
                this.task.description = task.description;
            }
        }
    }
</script>




<style scoped>

</style>

