<template>
    <div id="app">
        <section class="hero is-primary is-mobile is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="row">
                        <div class="columns">
                            <div class="column is-half is-offset-one-quarter">
                                <tarefa-card></tarefa-card>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import TarefaCard from './components/TarefaCard'

export default {
    name: 'app',
    components: {
        TarefaCard
    },
    data () {
        return {
            msg: 'Welcome to Your Vue.js App'
        }
    }
}
</script>

<style>
</style>
