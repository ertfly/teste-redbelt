db.createUser({
    user: 'teste',
    pwd: 'Teste@3661',
    roles: [
        {
            role: 'dbOwner',
            db: 'simulado',
        },
    ],
});