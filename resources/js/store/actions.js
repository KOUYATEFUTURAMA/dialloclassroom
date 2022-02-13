let actions = {
    ADD_COMMENT({ commit }, comment) {
        return new Promise((resolve, reject) => {
            axios
                .post(`/commentaire-store`, comment)
                .then(response => {
                    resolve(response);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    GET_COMMENTS({ commit }, postId) {
        axios
            .get("/liste-commentaires/" + postId)
            .then(res => {
                {
                    commit("GET_COMMENTS", res.data);
                }
            })
            .catch(err => {
                console.log(err);
            });
    },
    MARK_AS_RED_COMMENT({ commit }, comment) {
        return new Promise((resolve, reject) => {
            axios
                .post("/mark-as-read/", comment)
                .then(response => {
                    resolve(response);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
};
export default actions;
