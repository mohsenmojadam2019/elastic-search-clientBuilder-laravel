<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { watch } from "vue";

defineProps({
    books: {
        type: Object,
        default: () => ({}),
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },

});
let search = ref('');
watch(search, (value) => {
    router.get(
        "/books",
        { search: value },
        {
            preserveState: true,
        }
    );
});
const loadFallbackImage = (event) => {
    event.target.src = "https://play-lh.googleusercontent.com/_tslXR7zUXgzpiZI9t70ywHqWAxwMi8LLSfx8Ab4Mq4NUTHMjFNxVMwTM1G0Q-XNU80";
}
</script>

<template>
    <Head title="Welcome" />



    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control form-control-dark" v-model="search" placeholder="Search..."
                        aria-label="Search">
                </form>

                <div class="text-end">
                    <div v-if="canLogin" class=" text-right mb-3">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Dashboard</Link>

                        <template v-else>
                            <Link :href="route('login')" class="fbtn btn-outline-light me-2">
                            Log in</Link>

                            <Link v-if="canRegister" :href="route('register')" class="btn btn-warning">
                            Register</Link>
                        </template>
                    </div>
                    <!-- <button type="button" class="btn btn-outline-light me-2">Login</button>
          <button type="button" class="btn btn-warning">Sign-up</button> -->
                </div>
            </div>
        </div>
    </header>



    <section class="booklist mt-3 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section style="background-color: #eee" v-if="books.data.length>0">
                        <div class="container py-5">
                            <div class="row" >
                                <div v-for="book in books.data" :key="book.id" class="col-md-12 col-lg-3 mb-3 mb-lg-0">
                                    <div class="card text-black">
                                        <img :src="book.image" @error="loadFallbackImage" class="card-img-top"
                                            :alt="book.slug" />
                                        <div class="card-body">
                                            <div class="text-center mt-1">
                                                <h6 class="text-primary mb-1 pb-3">{{ book.title }}</h6>
                                                <h4 class="card-title">By :-{{ book.author }}</h4>
                                            </div>

                                            <div class="text-center">
                                                <div class="p-3 mx-n3 mb-4" style="background-color: #eff1f2">
                                                    <p class="mb-0" v-html="book.description.substring(0, 100) + '..'"></p>
                                                </div>

                                            </div>

                                            <div class="d-flex flex-row">
                                                <Link :href="route('book.detail', book.id)"
                                                    class="btn btn-outline-primary flex-fill me-1"
                                                    data-mdb-ripple-color="dark">
                                                View Detail
                                                </Link>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div className="my-4 mb-3 d-flex justify-content-center">
                            <ul className="pagination mb-3">
                                <li v-for="(link, index) in books.links" :key="index"
                                    :class="`page-item ${link.active ? 'active' : ''}`">
                                    <Link v-if="link.url !== null" :href="link.url" className="page-link"><span
                                        v-html="link.label"></span>
                                    </Link>
                                    <div v-else className="page-link" v-html="link.label">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section><section v-else>
                        <div class="container py-5">
                            <div class="row" >
                                <div class="col-md-12 text-center">
                                    No Books found.
                                </div>
                                </div>
                                </div>

                    </section>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
