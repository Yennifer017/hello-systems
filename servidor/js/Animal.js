function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

export class Animal {
    constructor(id, exp, level, atk, ps, name) {
        this.id = id;
        this.exp = exp;
        this.level = level;
        this.atk = atk;
        this.ps = ps;
        this.name = name;
    }

    atacar(objetivo) {
        if (!(objetivo instanceof Animal)) {
            throw new Error("El objetivo debe ser una instancia de Animal");
        }
        objetivo.ps -= this.atk;
        if (objetivo.ps < 0) {
            objetivo.ps = 0;
        }
    }

    isEfectiveDefense() {
        var random = getRandomInt(1, 100);
        return random < 30 + this.level;
    }

    isDefending() {
        var random = getRandomInt(1, 100);
        return random < 20 + this.level;
    }

}