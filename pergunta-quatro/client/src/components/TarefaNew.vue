<template>
    <div class="row">
        <div class="columns">
            <div class="column  is-half is-offset-one-quarter">
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
            descricao: ''
        }
    },
    updated: function () {
        console.log(this.editModule);
        if (typeof this.tarefa.id !== 'undefined' && this.editModule === false) {
            this.titulo     = this.tarefa.titulo
            this.descricao  = this.tarefa.descricao
            
            this.$emit('resetEditModule')
        }
    },
    methods: {
        enviarTarefa() {
            this.$emit('novaTarefa', {
                titulo: this.titulo, 
                descricao: this.descricao
            })

            this.titulo = ''
            this.descricao = ''
        },
        editarTarefa(){
            this.$emit('updateTarefa', {
                id: this.tarefa.id, 
                titulo: this.titulo, 
                descricao: this.descricao
            })

            this.titulo = ''
            this.descricao = ''          
        },
        cancelTarefa(){
            this.titulo = ''
            this.descricao = ''

            this.$emit('cancelTarefa')
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
</style>