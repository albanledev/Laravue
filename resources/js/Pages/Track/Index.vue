<template>

<!--        {{tracks}}-->
    <MusicLayout>

        <template #title>Musiques</template>


        <template #action>
        <Link :href="route('tracks.create')" class="button">Ajouter une musique</Link>
        </template>
        <template #content>
            <div>
                <input type="text" v-model="search" placeholder="Rechercher une musique" class="w-full m-6">

            </div>
            <div>
                <ul class="cards">
                    <li v-for="track in filteredTracks" :key="track.uuid" class="card" @click="play(track)" :class="{'border border-blue-500' : this.currentTrack === track.uuid  }">
                        <div class="image_container">
                            <img :src="'/storage/' + track.image" :alt="track.title">
                        </div>
                        <h1 class="">{{track.title}}</h1>
                        <h3>{{track.artist}}</h3>




                    </li>
                </ul>
            </div>

        </template>
    </MusicLayout>
<!--{{filteredTracks}}-->
</template>

<script>
import MusicLayout from "@/Layouts/MusicLayout.vue";
import {Link} from '@inertiajs/vue3'

export default {

    name: "Index",
    data(){
        return{
            search:'',
            audio:null,
            currentTrack:null,
        }
    },
    components:{MusicLayout, Link},
    computed:{
        filteredTracks(){
            return this.tracks.filter(track => track.title.toLowerCase().includes(this.search.toLowerCase())
            || track.artist.toLowerCase().includes(this.search.toLowerCase()))


        }
    },
    methods:{
        play(track){


            const url = '/storage/' +  track.music

            if(!this.currentTrack) {
                this.audio = new Audio(url);
                this.audio.play()
            }else if(this.currentTrack !== track.uuid) {
                this.audio.pause();
                this.audio.src = url;
                this.audio.play()
            }else if (this.currentTrack === track.uuid && !this.audio.paused){
                this.audio.pause()
            }else if (this.currentTrack === track.uuid && this.audio.paused){
                this.audio.play()
            }

            this.currentTrack = track.uuid
            this.audio.addEventListener('ended', () => {
                this.currentTrack = null
            })


            this.currentTrack = track.uuid;

            // console.log(audio)
        }
    },
    props: {
        tracks: {
            type:Array,
        },
    },
}
</script>

<style scoped>

    .cards{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 60px;
        list-style: none;
        padding: 0;
        width: fit-content;
        margin: auto;


    }
    .card{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 300px;
        height: 200px;
        border: 3px solid black;
        margin: 10px;
        border-radius: 20px;
        padding-top: 0.5rem;
        padding-bottom: 0.25rem;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        box-shadow: 0 0 10px rgba(0,0,0,0.8);


    }

    .card:hover{
        transition: all 0.2s ease-in-out;
        transform: scale(1.1);
    }

    .image_container {
        position: relative;
        width: 160px;
        height: 160px;
    }

    .image_container img{
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: contain;

    }

    .card h1{
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
    }

    .card h3{
        font-size: 1rem;
        font-style: italic;
    }
</style>
