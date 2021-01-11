<template>
    <div>
        <main class="py-4">
            <div class="form">
                <ul class="tab-group">
                    <li class="tab active"><a href="#login">Přihlásit</a></li>
                    <li class="tab"><a href="#register">Registrovat</a></li>
                </ul>
                <div class="tab-content">
                    <div id="login">
                        <form v-on:submit.prevent="login()">
                            <div class="field-wrap">
                                <label>
                                    Email<span class="req">*</span>
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    :class="{ 'is-invalid': errors.email }"
                                    v-model="details.email"
                                    required
                                    autocomplete="off"
                                    autofocus>
                                <span class="invalid-feedback" role="alert" v-if="errors.email">
                                        <strong>{{ errors.email[0] }}</strong>
                                </span>
                            </div>
                            <div class="field-wrap">
                                <label>
                                    Heslo<span class="req">*</span>
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    :class="{ 'is-invalid': errors.password }"
                                    v-model="details.password"
                                    required
                                    autocomplete="current-password">
                                <span class="invalid-feedback" role="alert" v-if="errors.password">
                                    <strong>{{ errors.password[0] }}</strong>
                                </span>
                            </div>
<!--                            @if (Route::has('password.request'))-->
<!--                            <p class="forgot"><a href="{{ route('password.request') }}">Zapomněl jste heslo?</a></p>-->

<!--                            {{--                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}-->
<!--                            {{--                        {{ __('Forgot Your Password?') }}--}}-->
<!--                            {{--                    </a>--}}-->
<!--                            @endif-->
                            <button type="submit" class="button button-block"/>Přihlásit</button>
                        </form>
                    </div>
                    <div id="register">
                        <form v-on:submit.prevent="register()">
                            <div class="field-wrap">
                                <label>
                                    Jméno<span class="req">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    :class="{ 'is-invalid': errors.name }"
                                    v-model="details.name"
                                    required
                                    autocomplete="off"
                                    autofocus>
                                <span class="invalid-feedback" role="alert" v-if="errors.name">
                                    <strong>{{ errors.name[0] }}</strong>
                                </span>
                            </div>
                            <div class="field-wrap">
                                <label>
                                    Email<span class="req">*</span>
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    :class="{ 'is-invalid': errors.email }"
                                    v-model="details.email"
                                    placeholder="Enter email"
                                    required
                                    autocomplete="off"
                                    autofocus>
                                <span class="invalid-feedback" role="alert" v-if="errors.email">
                                        <strong>{{ errors.email[0] }}</strong>
                                </span>
                            </div>
                            <div class="field-wrap">
                                <label>
                                    Heslo<span class="req">*</span>
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    :class="{ 'is-invalid': errors.password }"
                                    v-model="details.password"
                                    required
                                    autocomplete="current-password">
                                <span class="invalid-feedback" role="alert" v-if="errors.password">
                                    <strong>{{ errors.password[0] }}</strong>
                                </span>
                            </div>
                            <div class="field-wrap">
                                <label>
                                    Potvrzení hesla<span class="req">*</span>
                                </label>
                                <input
                                    v-model="details.password_confirmation"
                                    id="password-confirm"
                                    type="password"
                                    name="password_confirmation"
                                    required autocomplete="new-password">
                            </div>
                            <button class="button button-block"/>Registrovat</button>
                        </form>
                    </div>
                </div><!-- tab-content -->
            </div> <!-- /form -->
        </main>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        data: function() {
            return {
                details: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                }
            };
        },
        computed: {
            ...mapGetters([
                "errors",
                "userData",
            ])
        },
        mounted() {
            this.$store.commit("setErrors", {});
        },
        methods: {
            ...mapActions([
                "sendLoginRequest",
                "sendRegisterRequest"
            ]),
            login: function() {
                this.sendLoginRequest(this.details).then(() => {
                    // this.$router.push({ name: "Home" });
                });
            },
            register: function() {
                this.sendRegisterRequest(this.details).then(() => {
                    // this.$router.push({ name: "Home" });
                });
            }
        }
    };
</script>
