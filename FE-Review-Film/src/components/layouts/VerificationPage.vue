<template>
    <div v-motion :initial="{
        opacity: 0
    }" :visible="{
        opacity: 1,
    }" class="flex flex-col items-center justify-center gap-6 h-96 mt-10">
        <img src="@/assets/phone.svg" alt="" class="w-20">
        <h1 class="text-gray-400">You will get otp via Email</h1>
        <form action="">
            <label class="input input-bordered flex items-center gap-2">
                <input type="number" class="grow" placeholder="Input otp" />
            </label>
        </form>
        <button class="btn bg-sky-500 text-white">Verify</button>

    </div>
</template>
<style scoped>
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
