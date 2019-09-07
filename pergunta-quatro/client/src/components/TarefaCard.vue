<template>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title has-text-left">
                {{hoje}}
            </p>
            <div class="has-text-right">
                <p class="card-header-title">{{tarefas.length}} tarefas</p>
            </div>
        </header>
        <div class="card-content">
            <div class="content form-tarefa">
                <tarefa-new 
                    :tarefa="tarefa" 
                    :editModule="editModule" 

                    @novaTarefa="adicionarTarefa" 
                    @updateTarefa="editTarefa" 
                    @cancelTarefa="exitEdit"
                    @resetEditModule="waitEditModule"></tarefa-new>
            </div>
            <div class="content" :class="{'list-edit': tarefa.id}">
                <tarefa-list 
                    :tarefas="tarefas" 

                    @remover="removerTarefa" 
                    @edit="editFormTarefa"></tarefa-list>
            </div>
        </div>
    </div>
</template>

<script>
import TarefaNew from './TarefaNew'
import TarefaList from './TarefaList'

export default {
    name: 'tarefa-card',
    components: {
        TarefaNew,
        TarefaList
    },
    data() {
        return {
            dias: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            meses: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            tarefas: [],
            tarefa: {},
            editModule: false,
            tarefaIndex: false,
        }
    },
    mounted() {
        this.axios.get('http://localhost:8000/tarefa/')
            .then((response) => {
                this.tarefas = response.data
            })
            .catch((error) => {
                console.log(error)

                this.$swal({
                    type: 'error',
                    text: 'Um erro inesperado aconteceu por favor tentar novamente.',
                });
            })
    },
    computed: {
        hoje: function() {
            let novaData = new Date()
            return `${this.dias[novaData.getDay()]}, ${novaData.getDate()} de ${this.meses[novaData.getMonth()]}`
        }
    },
    methods: {
        adicionarTarefa(tarefa) {
            let nova_tarefa = {
                'titulo': tarefa.titulo, 
                'descricao': tarefa.descricao, 
                'prioridade': tarefa.prioridade, 
            }

            this.axios.post('http://localhost:8000/tarefa/', nova_tarefa)
                .then((response) => {
                    this.$swal({
                        type: 'success',
                        text: 'Tarefa cadastrada com sucesso!',
                    });

                    this.tarefas.push(response.data)
                    this.sortList()
                })
                .catch((error) => {
                    console.log(error)

                    this.$swal({
                        type: 'error',
                        text: 'Um erro inesperado aconteceu por favor tentar novamente.',
                    });
                })
        },
        removerTarefa(tarefa) {
            this.axios.delete('http://localhost:8000/tarefa/' + tarefa.id)
                .then((response) => {
                    this.$swal({
                        type: 'success',
                        text: 'Tarefa removida com sucesso!',
                    });

                    this.tarefas.splice(tarefa.index, 1)
                    this.sortList()
                })
                .catch((error) => {
                    console.log(error)

                    this.$swal({
                        type: 'error',
                        text: 'Um erro inesperado aconteceu por favor tentar novamente.',
                    });
                })
        },
        editFormTarefa(index) {
            this.tarefa = this.tarefas[index]
            this.tarefaIndex = index
            this.editModule = false
        },
        editTarefa(upTarefa) {            
            this.axios.put('http://localhost:8000/tarefa/' + upTarefa.id, upTarefa)
                .then((response) => {
                    this.$swal({
                        type: 'success',
                        text: 'Tarefa atualizada com sucesso!',
                    });

                    this.tarefas[this.tarefaIndex].titulo = response.data.titulo
                    this.tarefas[this.tarefaIndex].descricao = response.data.descricao
                    this.tarefas[this.tarefaIndex].prioridade = response.data.prioridade
                    
                    this.exitEdit()
                    this.sortList()
                })
                .catch((error) => {
                    console.log(error)

                    this.$swal({
                        type: 'error',
                        text: 'Um erro inesperado aconteceu por favor tentar novamente.',
                    });
                })
        },
        exitEdit() {
            this.tarefa = {}
            this.tarefaIndex = false
            this.editModule = true
        },
        waitEditModule(){
            this.editModule = true
        },
        sortList(){
            this.tarefas.sort(function(a, b) {
                return a.prioridade - b.prioridade;
            });
        }
    }
}
</script>

<style>
.card {
    border-radius: 10px;
}
.card-header-title {
    color: #636368;
}
.form-tarefa {
    box-shadow: 0 1px 2px rgba(10, 10, 10, 0.1);
}
.list-edit {
    display: none;
}
</style>