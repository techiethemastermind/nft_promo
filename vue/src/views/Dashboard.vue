<template>
  <PageComponent title="Dashboard">
     <form action="#" method="POST">
      <div class="overflow-hidden sm:rounded-md">
        <div class="px-4 bg-white">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-1 sm:col-span-1 flex items-center justify-center">
              <label for="first-name" class="block text-sm font-medium text-gray-700">Wallet Address:</label>
            </div>
            <div class="col-span-2 sm:col-span-2">
              <input type="text" name="first-name" id="first-name" autocomplete="given-name" v-model="ethWallet.address"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
            </div>
            <div class="col-span-1 sm:col-span-1">
              <button type="button" 
                @click="search"
                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">
                Search
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="py-4">
      <div v-if="errorMsg">{{ errorMsg }}</div>
      <div class="flex flex-wrap sm:flex-no-wrap items-center justify-between w-full">
        <div class="w-full h-64 rounded-t shadow bg-gray-200 dark:bg-gray-800"></div>
      </div>
    </div>
  </PageComponent>
</template>

<script setup>

  import PageComponent from "../components/PageComponent.vue";
  import { computed, ref } from "vue";
  import store from "../store";

  const ethWallet = {
    address: '0x00000000219ab540356cbb839cbe05303d7705fa',
  }
  const ethWalletData = computed(() => store.state.eth_info);
  let errorMsg = ref('');

  function search(ev) {
    store.dispatch('eth_wallet_info', ethWallet)
      .catch(err => {
        errorMsg.value = err.response.data.message;
      })
  }

</script>

<style lang="scss" scoped>

</style>