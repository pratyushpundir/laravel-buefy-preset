<template>
    <form @submit.stop.prevent="login">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Log in</p>
            </header>
            <section class="modal-card-body">
                <b-field label="Email">
                    <b-input
                        name="email"
                        type="email"
                        ref="emailInput"
                        v-model="email"
                        placeholder="Your email"
                        required
                        autofocus>
                    </b-input>
                </b-field>

                <b-field label="Password">
                    <b-input
                        name="password"
                        type="password"
                        ref="passwordInput"
                        v-model="password"
                        password-reveal
                        placeholder="Your password"
                        required>
                    </b-input>
                </b-field>

                <b-checkbox v-model="rememberMe">Remember Me</b-checkbox>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" :class="['button', 'is-primary', {
                    'is-loading': isLoading
                }]">Login</button>
            </footer>
        </div>
    </form>
</template>

<script>
    export default {
        data () {
            return {
                rememberMe: false,
                email: '',
                password: '',
                isLoading: false
            }
        },

        methods: {
            login () {
                this.isLoading = true
                
                setTimeout(() => {
                    this.isLoading = false
                    this.$parent.close()

                    this.$snackbar.open({
                        message: 'Fake login successful!',
                        type: 'is-success',
                        position: 'is-top',
                        actionText: 'Close'
                    })
                }, 1200);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .modal-card {
        width: 320px !important;
    }
</style>
