class CacheStorage{
    key = '';
    storage = null;

    constructor(key){
        this.key = key
        this.storage = JSON.parse(localStorage.getItem(this.key));
    }


    has(){
        return !! this.storage
    }

    get(){
        return this.has() ? this.storage : []
    }

    set(files){
        localStorage.setItem(this.key , JSON.stringify(files))
    }

    clear(){
        localStorage.removeItem(this.key)
    }
}