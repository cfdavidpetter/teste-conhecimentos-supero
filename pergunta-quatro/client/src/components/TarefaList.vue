<template>
    <div class="row">
        <div class="columns">
            <div class="column">
                <div v-for="(tarefa, index) in tarefas">
                    <div class="field is-grouped">
                        <p class="control is-expanded" :class="{'checked': tarefa.checked == 'Y'}">
                            <b>{{tarefa.titulo}}</b>
                            <br>
                            <span class="tag is-success" v-if="tarefa.prioridade == 3">Baixa</span> 
                            <span class="tag is-warning" v-if="tarefa.prioridade == 2">Média</span> 
                            <span class="tag is-danger" v-if="tarefa.prioridade == 1">Alta</span> 
                            {{tarefa.descricao}}                            
                        </p>
                        <p class="control">
                            <a class="button is-info is-small" @click="edit(index)">
                                <span class="icon is-small">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </a>
                            <a class="button is-danger is-small" @click="remover(index, tarefa.id)">
                                <span class="icon is-small">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </a>
                        </p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'tarefa-list',
    props: ['tarefas'],
    data () {
        return {}
    },
    methods: {
        edit(index) {
            this.$emit('edit', index)
        },
        remover(indexArray, idTarefa) {
            this.$emit('remover', {
                index: indexArray, 
                id: idTarefa
            })
        }
    }
}
</script>

<style scoped>
.button {
    border-radius: 50%;
}
.checked {
    text-decoration: line-through;
}
</style>