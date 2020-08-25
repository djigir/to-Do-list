<template id="task-create">

    <div>
        <h3 v-if="this.task.id !== null">Редактирование задачи</h3>
        <h3 v-else>Создание новой задачи</h3>
        <ValidationObserver v-slot="{ valid }">
            <form v-on:submit.prevent="createOrUpdate(task.id)">
                <div class="form-group">
                    <label for="title">Название</label>
                    <ValidationProvider name="название" rules="required|min:5|max:30" v-slot="{ errors }">
                        <input type="text" v-model="task.title" class="form-control" name="title" id="title" placeholder="Введите название задачи" required>
                        <span v-if="errors[0]">
                        {{ errors[0] }}
                    </span>
                    </ValidationProvider>
                </div>
                <div class="form-group">
                    <label for="create-description">Описание</label>
                    <ValidationProvider name="описание" rules="required|min:5|max:50" v-slot="{ errors }">
                        <textarea v-model="task.description" class="form-control" id="create-description" rows="10" placeholder="Введите описания задачи" required></textarea>
                        <span v-if="errors[0]">
                        {{ errors[0] }}
                    </span>
                    </ValidationProvider>
                </div>
                <button type="submit" :disabled="!valid" class="btn btn-success">Создать задачу</button>
                <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Назад</router-link>
            </form>
        </ValidationObserver>
    </div>

</template>


<script>

    import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';
    import { localize } from 'vee-validate';
    import ru from 'vee-validate/dist/locale/ru';

    localize('ru', ru);

    export default {

        components: {
            ValidationObserver,
            ValidationProvider,
        },


        data() {
            return {
                task: {
                    id: null,
                    title: '',
                    description: '',
                },
                edit_url: null
            }
        },

        mounted() {
            this.edit_url = this.$router.currentRoute.params.id;
            if (this.edit_url) {
                Axios.get('http://to-do-list/api/tasks/'+this.$route.params.id)
                    .then(response => (
                        this.task = response.data
                    ))
            }
        },

        methods: {

            createOrUpdate(id) {
                if (id === null) {
                    this.createTask();
                } else {
                    this.updateTask();
                }
            },

            createTask() {
                let uri = 'http://to-do-list/api/tasks';
                Axios.post(uri, this.task)
                    .then((response) => {
                        this.$router.push({name: 'TaskList'});
                    });
            },

            updateTask() {
                let uri = 'http://to-do-list/api/tasks/' + this.task.id;
                Axios.patch(uri, this.task)
                    .then((response) => {
                        this.$router.push({name: 'TaskList'});
                    });
            }
        }

    }

</script>


<style scoped>

    form span{
        color: red;
    }

</style>