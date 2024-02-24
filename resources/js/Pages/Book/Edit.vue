<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import moment from "moment"
const props = defineProps({
    books: {
        type: Object,
        default: () => ({}),
    },
});

const format_date=(value)=>{
         if (value) {
           return moment(String(value)).format('YYYY-MM-DD')
          }
      };
const form = useForm({
    id:props.books.id,
    title: props.books.title,
    author: props.books.author,
    genre: props.books.genre,
    isbn: props.books.isbn,
    publisher: props.books.publisher,
    published: format_date(props.books.published),
    image: props.books.image,
    description: props.books.description,

});

const submit = () => {
    form.put(route("book.update",props.books.id));
};
</script>
<template>
    <Head title="books" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Books</h2>
        </template>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <Link  :href="route('book.index')" class="btn btn-outline-success btn-lg float-right">List Books</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">


                            <form class="row g-3" @submit.prevent="submit">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Book Title</label>
                                    <input type="text" class="form-control" id="title" v-model="form.title">
                                    <div v-if="$page.props.errors.title"  class="text-danger">{{ $page.props.errors.title }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author" v-model="form.author">
                                    <div v-if="$page.props.errors.author"  class="text-danger">{{ $page.props.errors.author }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="genre" class="form-label">Genre</label>
                                    <input type="text" class="form-control" id="genre" v-model="form.genre">
                                    <div v-if="$page.props.errors.genre"  class="text-danger">{{ $page.props.errors.genre }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="isbn" class="form-label">Isbn</label>
                                    <input type="text" class="form-control" id="isbn" v-model="form.isbn">
                                    <div v-if="$page.props.errors.isbn"  class="text-danger">{{ $page.props.errors.isbn }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="publisher" class="form-label">Publisher</label>
                                    <input type="text" class="form-control" id="publisher" v-model="form.publisher">
                                    <div v-if="$page.props.errors.publisher"  class="text-danger">{{ $page.props.errors.publisher }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="published" class="form-label">Published</label>
                                    <input type="date" class="form-control" id="published" v-model="form.published">
                                    <div v-if="$page.props.errors.published"  class="text-danger">{{ $page.props.errors.published }}</div>
                                </div>
                                <div class="col-12">
                                    <label for="image" class="form-label">Image Url</label>
                                    <input type="text" class="form-control" id="image"
                                        placeholder="http://placeimg.com/480/640/any" v-model="form.image">
                                        <div v-if="$page.props.errors.image"  class="text-danger">{{ $page.props.errors.image }}</div>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" placeholder="Description"
                                        v-model="form.description">
                                        <div v-if="$page.props.errors.description" class="text-danger">{{ $page.props.errors.description }}</div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
