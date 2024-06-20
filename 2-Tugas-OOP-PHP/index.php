<?php

abstract class Hewan {
    protected string $nama, $keahlian;
    protected float $darah = 50, $jumlahKaki;

    protected function __construct(string $nama, string $keahlian, int $jumlahKaki)
    {
        $this->nama = $nama;
        $this->keahlian = $keahlian;
        $this->jumlahKaki = $jumlahKaki;
    }

    public function atraksi() {
        return "$this->nama sedang $this->keahlian";
    }

    abstract public function getInfoHewan();

}

trait Fight {
    public int $attackPower, $defencePower;

    public function serang(Object $hewan1) {

        echo "$this->nama sedang menyerang $hewan1->nama" . "<br>";
        $this->diserang($hewan1);
    }

    public function diserang(Object $hewan1) {
        $hewan1->darah -= $this->attackPower / $hewan1->defencePower;

        echo "$hewan1->nama sedang diserang $this->nama" . "<br>";
    }
}

class Elang extends Hewan {
    use Fight;

    public function __construct(string $nama, int $jumlahKaki = 2) {
        parent::__construct($nama, 'terbang tinggi', $jumlahKaki);
        $this->attackPower = 10;
        $this->defencePower = 5;
    }

    public function getInfoHewan()
    {
        echo 'Nama : ' . $this->nama . "<br>";
        echo 'Darah : ' . $this->darah . "<br>";
        echo 'JumlahKaki : ' . $this->jumlahKaki . "<br>";
        echo 'Keahlian : ' . $this->keahlian . "<br>";
        echo 'AttackPower : ' . $this->attackPower . "<br>";
        echo 'DefencePower : ' . $this->defencePower . "<br>";
        echo "Jenis : " . __CLASS__;
    }

}

class Harimau extends Hewan {
    use Fight;

    public function __construct(string $nama, int $jumlahKaki = 4) {
        parent::__construct($nama, 'lari cepat', $jumlahKaki);
        $this->attackPower = 7;
        $this->defencePower = 8;
    }

    public function getInfoHewan()
    {
        echo 'Nama : ' . $this->nama . "<br>";
        echo 'Darah : ' . $this->darah . "<br>";
        echo 'JumlahKaki : ' . $this->jumlahKaki . "<br>";
        echo 'Keahlian : ' . $this->keahlian . "<br>";
        echo 'AttackPower : ' . $this->attackPower . "<br>";
        echo 'DefencePower : ' . $this->defencePower . "<br>";
        echo "Jenis : " . __CLASS__;
    }

}

$elang = new Elang('Elang');
$harimau = new Harimau('Harimau');

echo $elang->atraksi() . "<br>";
echo $harimau->atraksi() . "<br>";

echo "<hr>";
$elang->serang($harimau);
$harimau->getInfoHewan();

echo "<hr>";
$harimau->serang($elang);
$elang->getInfoHewan();
