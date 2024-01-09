<template>

    <!--        {{tracks}}-->
    <MusicLayout>

        <template #title>
            Las musicas
        </template>
        <template #action>
            <Link :href="route('tracks.index')">Mon dashboard</Link>
        </template>

        <template #content>

            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Titre
                    </label>
                    <input
                        id="title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline   "
                        type="text"
                        :class="{ 'border-red-500': form.errors.title }"
                        placeholder="Title"
                        v-model="form.title"
                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.title }}</p>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="artiste">
                        Artiste
                    </label>
                    <input
                        id="artiste"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline   "
                        type="text"
                        :class="{ 'border-red-500': form.errors.artist }"
                        placeholder="Title"
                        v-model="form.artist"
                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.artist }}</p>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Image
                    </label>
                    <input
                        id="image"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline   "
                        type="file"
                        :class="{ 'border-red-500': form.errors.image }"
                        placeholder="Image"
                        @input="form.image=$event.target.files[0]"

                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.image}}</p>
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="music">
                        Music
                    </label>
                    <input
                        id="music"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline   "
                        type="file"
                        :class="{ 'border-red-500': form.errors.music }"
                        placeholder="Music"
                        @input="form.music=$event.target.files[0]"
                    >
                    <p class="text-red-500 text-xs italic">{{ form.errors.music }}</p>
                </div>

                {{form.errors}}
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="display">
                        Afficher:
                    </label>
                <select v-model="form.display" id="display">
                    <option value="true">Oui</option>
                    <option value="false">Non</option>
                </select>
                </div>

                <button type="submit" class="text-white bg-indigo-500 px-3 py-2 rounded-full">Valider</button>
            </form>
        </template>
    </MusicLayout>


</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import {Link} from "@inertiajs/vue3";
export default {

    name: "Index",
    components:{MusicLayout,Link},
    data(){
        return {
            form: this.$inertia.form({
                title:'',
                artist:'',
                image:null,
                music:null,
                display:true,

            })
        }
    },
    props: {
        tracks: {
            type:Array,
        },
    },

    methods:{
        submit(){
            this.form.post(route('tracks.store'))
        }
    }
}
</script>

<style scoped>

</style>
