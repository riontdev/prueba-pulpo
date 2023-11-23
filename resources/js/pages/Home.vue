<template>
 <div class="mx-auto w-4/12 mt-10 bg-blue-200 p-4 rounded-lg">
        <div
            class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-2 flex flex-col"
        >
            <h1 class="text-gray-600 py-5 font-bold text-3xl"> Calculadora Conversion </h1>
            <ul class="list-disc text-red-400" v-for="(value, index) in errors" :key="index" v-if="typeof errors === 'object'">
                <li>{{value[0]}}</li>
            </ul>
            <p class="list-disc text-red-400" v-if="typeof errors === 'string'">{{errors}}</p>
            <form method="post" @submit.prevent="handleLogin">
             <label
                      class="block text-grey-darker text-sm font-bold mb-2"
                      for="password"
                  >
                      De:
                  </label>
              <select
                id="countries"
                class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                v-model="form.from_currency"
                >
                <option
                    v-for="currency in currencies"
                    :key="currency.short_name"
                    :value="currency.short_name"
                >
                    {{ currency.name }}
                </option>
            </select>
              <div class="mb-4">
                  <label
                      class="block text-grey-darker text-sm font-bold mb-2"
                      for="password"
                  >
                      A:
                  </label>
                  <select
                    id="countries"
                    class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                    v-model="form.to_currency"
                    >
                    <option
                        v-for="currency in currencies"
                        :key="currency.short_name"
                        :value="currency.short_name"
                    >
                        {{ currency.name }}
                    </option>
                    </select>
                    <label
                        class="block text-grey-darker text-sm font-bold mb-2"
                        for="password"
                    >
                        Importe:
                    </label>
                  <input
                      class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3"
                      id="amount"
                      type="number"
                      v-model="form.amount"
                      required
                  />
              </div>


              <div class="flex items-center justify-between">
                    <label
                        class="block text-grey-darker text-sm font-bold mb-2"
                    >
                        Total: {{this.total}} {{this.currency}}
                    </label>
                  <button
                      class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                      type="submit"
                  >
                      Convertir
                  </button>
              </div>
            </form>
        </div>
    </div>
</template>
<script>
import {request} from '../helper';

export default {
  data() {
    return {
      errors: '',
      form: {
        to_currency: '',
        from_currency: '',
        amount: '',
      },
      total: '',
      currency: '',
      currencies: [],
    };
  },
  mounted() {
    this.loadCurrencies();
  },
  methods: {
    async loadCurrencies() {
      try {
        const response = await request('get','/internal_api/currency_calculator');
        const arrayCurrencies = Object.entries(response.data.data).map(([short_name, name]) => ({
        short_name,
        name
        }));
        this.currencies = arrayCurrencies
      } catch (error) {
        console.error('Error fetching currencies:', error);
      }
    },
    async handleLogin() {
      try {
        const result = await request('post','/internal_api/currency_calculator', this.form);
        if (result.status === 201 && result.data && result.data.data) {
            this.total = result.data.data.amount;
            this.currency = result.data.data.currency;
        }
      } catch (e) {
        await this.$router.push('/app/login');
      }
    },
  },
};
</script>