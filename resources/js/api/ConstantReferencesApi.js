import axios from "axios";

export default {
    getRate(temperature) {
        return axios.get(`/api/v1/getRate?temperature=${temperature}`, {
            headers: {Accept: 'application/json'}
        });
    },

    getTable() {
        return axios.get("/api/v1/getTable");
    },

    getConstant() {
        return axios.get("/api/v1/getConstant");
    }

};
