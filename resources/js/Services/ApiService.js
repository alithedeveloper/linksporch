import axios from 'axios';

class Service {
    constructor(loading=false) {
        let service = axios.create();
        this.loading = loading
        service.interceptors.request.use(this.handleRequestStart, this.handleRequestError)
        service.interceptors.response.use(this.handleSuccess, this.handleError);
        this.service = service;
    }

    handleSuccess(response) {
        this.loading = false
        return response;
    }

    handleRequestStart(config){
        this.loading = true
        return config
    }
    handleRequestError = (error) => {
        this.loading = false
        return new Promise.reject(error)
    }

    handleError = (error) => {
        this.loading = false
        switch (error.response.status) {
            case 401:
                this.redirectTo(document, '/')
                break;
            case 404:
                this.redirectTo(document, '/404')
                break;
            default:
                this.redirectTo(document, '/500')
                break;
        }
        return Promise.reject(error)
    }

    redirectTo = (document, path) => {
        document.location = path
    }

    get(path, callback) {
        return this.service.get(path).then(
            (response) => callback(response.status, response.data)
        );
    }

    patch(path, payload, callback) {
        return this.service.request({
            method: 'PATCH',
            url: path,
            responseType: 'json',
            data: payload
        }).then((response) => callback(response.status, response.data));
    }

    post(path, payload, callback) {
        return this.service.request({
            method: 'POST',
            url: path,
            responseType: 'json',
            data: payload
        }).then((response) => callback(response.status, response.data));
    }
}

export default new Service;
