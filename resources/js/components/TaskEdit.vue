<template id="task-edit">
    <div>
        <h3>Редактирование <strong>{{ task.title }}</strong></h3>

        <ValidationObserver v-slot="{ valid }">
        <form v-on:submit.prevent="updateTask">
            <div class="form-group">
                <label for="edit-title">Название</label>
                <ValidationProvider name="название" rules="required|min:5|max:30" v-slot="{ errors }">
                    <input type="text" v-model="task.title" class="form-control" id="edit-title" placeholder="Введите название задачи" required>
                    <span v-if="errors[0]">
                        {{ errors[0] }}
                    </span>
                </ValidationProvider>
            </div>
            <div class="form-group">
                <label for="edit-description">Описание</label>
                <ValidationProvider name="описание" rules="required|min:5|max:50" v-slot="{ errors }">
                    <textarea v-model="task.description" class="form-control" id="edit-description" rows="10" placeholder="Введите описания задачи"></textarea>
                    <span v-if="errors[0]">
                        {{ errors[0] }}
                    </span>
                </ValidationProvider>
            </div>
            <button type="submit" class="btn btn-success">Создать задачу</button>
            <router-link class="btn btn-xs btn-warning" v-bind:to="'/'">Назад</router-link>
        </form>
        </ValidationObserver>

    </div>
</template>


<script>

    import { ValidationProvider, ValidationObserver } from 'vee-validate/dist/vee-validate.full';

    export default {

        components: {
            ValidationObserver,
            ValidationProvider
        },

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

