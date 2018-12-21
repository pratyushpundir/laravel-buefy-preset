<template>
    <form @submit.stop.prevent="register">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Register</p>
            </header>
            <section class="modal-card-body">
                <b-field label="Fullname">
                    <b-input
                        name="name"
                        type="text"
                        ref="nameInput"
                        v-model="fullname"
                        placeholder="Your name"
                        required
                        autofocus>
                    </b-input>
                </b-field>

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

                <b-field
                    label="Password"
                    :type="{
                        'is-success': pwdConfirmMatches,
                        'is-danger': !pwdConfirmMatches && !!pwdConfirmMessage
                    }"
                >
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

                <b-field
                    label="Confirm Password"
                    :type="{
                        'is-success': pwdConfirmMatches,
                        'is-danger': !pwdConfirmMatches && !!pwdConfirmMessage
                    }"
                    :message="pwdConfirmMessage"
                >
                    <b-input
                        name="confirm_password"
                        type="password"
                        ref="confirmPasswordInput"
                        v-model="confirmPassword"
                        password-reveal
                        placeholder="Confirm password"
                        required>
                    </b-input>
                </b-field>

                <b-checkbox v-model="subscribe">Subscribe to our newsletter</b-checkbox>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" :class="['button', 'is-primary', {
                    'is-loading': isLoading
                }]">Sign Up</button>
            </footer>
        </div>
    </form>
</template>

<script>
    export default {
        data () {
            return {
                subscribe: false,
                fullname: '',
                email: '',
                password: '',
                confirmPassword: '',
                isLoading: false
            }
        },

        computed: {
            pwdConfirmMatches () {
                if (this.password == '' || this.confirmPassword == '') {
                    return false
                }

                return this.password === this.confirmPassword
            },

            pwdConfirmMessage () {
                if (this.password == '' || this.confirmPassword == '') {
                    return ''
                }

                if (this.pwdConfirmMatches) {
                    return 'Password confirmation matches'
                } else {
                    return 'Password confirmation does not match!'
                }
            }
        },

        methods: {
            register () {
                this.isLoading = true
                
                setTimeout(() => {
                    this.isLoading = false
                    this.$parent.close()
                    
                    this.$snackbar.open({
                        message: 'Fake signup successful!',
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
