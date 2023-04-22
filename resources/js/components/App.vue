<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">

                    <div class="card-header">
                        <div class="d-flex justify-content-center fs-4">
                            Калькулятор объема газа
                        </div>
                    </div>

                    <div class="card-body mt-3">
                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-black" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Константы</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-black active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Расчет</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div>
                                    <b>Стандартная калорийность:</b> {{calDefault}} ккал/м3
                                </div>
                                <div class="mb-3">
                                    <b>Стандартная цена газа:</b> {{priceDefault}} рублей
                                </div>
                                <br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Температура от</th>
                                            <th scope="col">Температура до</th>
                                            <th scope="col">Коэффициент</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="row in tableRates" :key="row.id">
                                            <th scope="row">{{row.id}}</th>
                                            <td>{{row.temperatureMin}}</td>
                                            <td>{{row.temperatureMax}}</td>
                                            <td>{{row.rate}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show active p-3" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex flex-column w-50">
                                        <form>
                                            <div class="mb-2">
                                                <label for="valueOld" class="form-label">Предыдущие показания счетчика (м3)</label>
                                                <input type="number" class="form-control" id="valueOld" v-model="valueOld">
                                            </div>
                                            <div class="mb-2">
                                                <label for="valueNew" class="form-label">Конечные показания счетчика (м3)</label>
                                                <input type="number" class="form-control" id="valueNew" v-model="valueNew">
                                            </div>
                                            <div class="mb-2">
                                                <label for="cal" class="form-label">Калорийность газа (ккал/м3)</label>
                                                <input type="number" class="form-control" id="cal" v-model="cal">
                                            </div>
                                            <div class="mb-2">
                                                <label for="temperature" class="form-label">Температура (в градусах Цельсия)</label>
                                                <input type="number" class="form-control" id="temperature" v-model="temperature">
                                            </div>
                                            <div class="d-flex justify-content-center mt-4">
                                                <button type="submit" class="btn btn-success" :disabled="error || !allValuesFilled" @click.prevent="calcResult">Рассчитать</button>
                                                <button type="submit" class="btn btn-light mx-3" v-if="result" @click.prevent="removeResult">Очистить</button>
                                            </div>
                                        </form>

                                        <div class="text-center mt-4 text-bg-danger" v-if="error">{{errorText}}</div>
                                        <div class="text-center mt-4 fs-6 text-bg-light" v-if="result">{{resultText}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../api/ConstantReferencesApi"

export default {
        data() {
            return {
                priceDefault: null,
                calDefault: null,
                tableRates: [],
                valueOld: null,
                valueNew: null,
                cal: null,
                temperature: 20,
                rate: null,
                error: false,
                errorText: "",
                result: false,
                resultText: ""
            }
        },

        async mounted() {
            await this.getTable();
            await this.getConstant();
            await this.getRate(this.temperature);
        },

        methods: {
            async getTable() {
                await api.getTable().then(res => {
                    this.tableRates = res.data.data;
                })
            },

            async getRate(temperature) {
                await api.getRate(temperature).then(res => {
                    this.rate = res.data.data.rate;
                    this.errorText = "";
                    this.error = false;
                }).catch(e => {
                    this.error = true;
                    this.errorText = e.response.data.data.error;
                })
            },

            async getConstant() {
                await api.getConstant().then(res => {
                    this.priceDefault = res.data.data.priceDefault.value;
                    this.calDefault = res.data.data.calDefault.value;
                })
            },

            async calcResult() {
                this.result = false;
                this.resultText = "";

                if (!this.allValuesFilled) {
                    return;
                }

                await this.getRate(this.temperature);
                if (this.error) {
                    return;
                }

                let qty;
                let price;

                qty = (this.valueNew - this.valueOld) * this.rate;
                price = this.priceDefault * this.cal / this.calDefault;

                this.result = true;
                this.resultText =  `Потребление: ${Math.round(qty)} ккал/м3, Цена: ${price.toFixed(2)} рублей`;
            },

            removeResult() {
                this.valueOld = null;
                this.valueNew = null;
                this.cal = null;
                this.temperature = 20;

                this.result = false;
                this.resultText = "";
            }
        },

        watch: {
            valueOld(newValue, oldValue) {
                if (newValue !== oldValue) {
                    if (newValue > this.valueNew) {
                        this.errorText = "Предыдущие показания меньше текущих!";
                        this.error = true;
                    } else {
                        this.errorText = "";
                        this.error = false;
                    }
                }
            },

            valueNew(newValue, oldValue) {
                if (newValue !== oldValue) {
                    if (newValue < this.valueOld) {
                        this.errorText = "Текущие показания меньше предыдущих!";
                        this.error = true;
                    } else {
                        this.errorText = "";
                        this.error = false;
                    }
                }
            },

            cal(newValue, oldValue) {
                if (newValue !== oldValue) {
                    if (newValue < 5000 || newValue > 10000) {
                        this.errorText = "Калорийность вне диапазона (от 5000 до 10000)";
                        this.error = true;
                    } else {
                        this.errorText = "";
                        this.error = false;
                    }
                }
            },

            temperature(newValue, oldValue) {
                if (newValue !== oldValue) {
                    if (newValue === "") {
                        this.errorText = "Не корректно заполнена температура";
                        this.error = true;
                    } else {
                        this.errorText = "";
                        this.error = false;
                    }
                }
            },
        },

        computed: {
            allValuesFilled() {
                return this.valueOld !== null &&
                    this.valueNew !== null &&
                    this.cal !== null &&
                    this.temperature !== null &&
                    this.rate !== undefined;
            }
        }

    }
</script>
