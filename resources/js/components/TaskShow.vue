<template id="show-task">

    <div>
        <h3>{{ task.title }}</h3>
        <strong>Описание: </strong>
        <div class="task-body">
            <p>{{ task.description }}</p>
        </div>
        <span class="glyphicon glyphicon-arrow-left"></span>
        <router-link v-bind:to="'/'">Назад к списку задач</router-link>

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
            let uri = 'http://to-do-list/api/tasks/'+this.$route.params.id;
            Axios.get(uri)
                .then((response) => {
                    this.task = response.data;
                })
        }

    }

</script>

