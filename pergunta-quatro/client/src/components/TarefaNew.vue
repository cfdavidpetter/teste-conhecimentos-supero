<template>
    <div class="row">
        <div class="columns">
            <div class="column">
                <fieldset>
  
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="Titulo" v-model="titulo">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input class="input" type="email" placeholder="Descrição" v-model="descricao">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control radio-form">
                            <label class="radio radio-baixo">
                                <input type="radio" id="baixo" name="3" value="3" v-model="prioridade">
                                <b>Prioridade Baixa</b>
                            </label>
                            <label class="radio radio-medio">
                                <input type="radio" id="one" name="2" value="2" v-model="prioridade">
                                <b>Prioridade Médio</b>
                            </label>
                            <label class="radio radio-alto">
                                <input type="radio" id="one" name="1" value="1" v-model="prioridade">
                                <b>Prioridade Alto</b>
                            </label>
                        </div>
                    </div>
                    
                    <div v-if="tarefa.id">
                        <a class="button is-danger" @click="cancelTarefa">Cancelar</a>
                        <a class="button is-success" @click="editarTarefa">Atualizar</a>
                    </div>
                    <div v-else>
                        <a class="button is-success" @click="enviarTarefa">
                            <span class="icon">
                                <i class="fa fa-plus"></i>
                            </span>
                        </a>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'tarefa-new',
    props: {
        tarefa: Object,
        editModule: Boolean,
    },
    data () {
        return {
            titulo: '',
            descricao: '',
            prioridade: 3
        }
    },
    updated: function () {
        if (typeof this.tarefa.id !== 'undefined' && this.editModule === false) {
            this.titulo     = this.tarefa.titulo
            this.descricao  = this.tarefa.descricao
            this.prioridade  = this.tarefa.prioridade

            this.$emit('resetEditModule')
        }
    },
    methods: {
        enviarTarefa() {
            this.$emit('novaTarefa', {
                titulo: this.titulo, 
                descricao: this.descricao,
                prioridade: this.prioridade
            })

            this.resetVar()
        },
        editarTarefa(){
            this.$emit('updateTarefa', {
                id: this.tarefa.id, 
                titulo: this.titulo, 
                descricao: this.descricao,
                prioridade: this.prioridade
            })

            this.resetVar()
        },
        cancelTarefa(){
            this.resetVar()
            this.$emit('cancelTarefa')
        },
        resetVar(){
            this.titulo = ''
            this.descricao = ''          
            this.prioridade = 3
        }
    }
}
</script>

<style scoped>
.input {
    border-left: 0;
    border-right: 0;
    border-top: 0;
    border-radius: 0;
    outline: none;
    border-bottom-width: 2px;
    box-shadow: none;
}
.input.is-primary:focus {
    box-shadow: none;
}
.add-button {
    border-radius: 50%;
}
.radio-form {
    padding-left: 15px;
    opacity: 0.7;
}
.radio-baixo {
    color: green;
}
.radio-medio {
    color: yellow;
}
.radio-alto {
    color: red;
}
</style>