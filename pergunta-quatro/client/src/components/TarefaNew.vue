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

                    <a class="button is-success" @click="enviarTarefa">
                        <span class="icon">
                            <i class="fa fa-plus"></i>
                        </span>
                    </a>

                </fieldset>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'tarefa-new',
    data () {
        return {
            titulo: '',
            descricao: ''
        }
    },
    methods: {
        enviarTarefa() {
            if (this.tarefa != '') {
                this.$emit('novaTarefa', {titulo: this.titulo, descricao: this.descricao})
            }
            this.titulo = ''
            this.descricao = ''
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