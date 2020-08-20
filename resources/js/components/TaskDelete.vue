<template id="task-delete">

    <div>
        <h3>Удаления задачи {{ task.title }}</h3>

        <form v-on:submit.prevent="deleteTask">
            <button type="submit" class="btn btn-danger">Удалить</button>
            <router-link class="btn btn-primary" v-bind:to="'/'">Назад</router-link>
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

        created(){
            let uri = 'http://to-do-list/api/tasks/'+this.$route.params.id;
            Axios.get(uri)
                .then((response) => {
                    this.task = response.data;
                })
        },

        methods: {
            deleteTask() {
                if (confirm('Вы уверены что хотите удалить эту задачу?')){
                    let uri = 'http://to-do-list/api/tasks/'+this.$route.params.id;
                    Axios.delete(uri, this.task)
                        .then((response) => {
                            this.$router.push({name: 'TaskList'});
                        });
                }
            }
        }
    }

</script>
