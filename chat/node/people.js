function People(sockets, company, user, name, device) {
    this.sockets = sockets;
    this.company = company;
    this.user = user;
    this.name = name;
    this.device = device;
    this.status = 1;
};

module.exports = People;