<?php 

enum Sexo: string {
    case Masculino = 'Masculino';
    case Feminino = 'Feminino';
    case NaoInformar = 'Nao responder';
}

enum UF: string {
    case AC = 'AC';
    case AL = 'AL';
    case AP = 'AP';
    case AM = 'AM';
    case BA = 'BA';
    case CE = 'CE';
    case DF = 'DF';
    case ES = 'ES';
    case GO = 'GO';
    case MA = 'MA';
    case MT = 'MT';
    case MS = 'MS';
    case MG = 'MG';
    case PA = 'PA';
    case PB = 'PB';
    case PR = 'PR';
    case PE = 'PE';
    case PI = 'PI';
    case RJ = 'RJ';
    case RN = 'RN';
    case RS = 'RS';
    case RO = 'RO';
    case RR = 'RR';
    case SC = 'SC';
    case SP = 'SP';
    case SE = 'SE';
    case TO = 'TO';
}

enum Genero: String {
    case Masculino = "Homem cisgenero";
    case Feminino = "Mulher cisgenero";
    case Bigenero = "Bigenero";
    case Transgenero = "Mulher transgenero";
    case GeneroNeutro = "Genero neutro";
    case NaoBinario = "Genero nao-binario";
    case Agenero = "Agenero";
    case Pangenero = "Poligenero";
    case Genderqueer = "Genero-fluido";
    case MulherTrans = "Mulher transexual";
    case HomemTrans = "Homem transexual";
    case Outros = "Outros";
}

enum Doenca: string {
    case Nefrite = 'Nefrite';
    case Conjutivite = 'Conjutivite';
    case Renite = 'Renite';
    case Asma = 'Asma';
    case Tendinite = 'Tendinite';
}

class Paciente {

    private string $nome;
    private string $rg;
    private string $cns;
    private string $telefone;
    private string $cep;
    private string $endereco;
    private string $bairro;
    private string $numero;
    private string $cidade;
    private string $nomeMae;
    private string $email;
    private Genero $genero;
    private Sexo $sexo;
    private UF $uf;
    private Doenca $doenca;
    private string $dataDeNascimento;
    private string $complemento;
    private string $comentario;
    

    public function __construct( 
        string $nome,
        string $rg,
        string $cns,
        string $telefone,
        string $cep,
        string $endereco,
        string $bairro,
        string $numero,
        string $cidade,
        string $nomeMae,
        string $email,
        Genero $genero,
        Sexo $sexo,
        UF $uf,
        Doenca $doenca,
        string $dataDeNascimento,
        string $complemento,
        string $comentario
    ) {
        $this->nome = $nome;
        $this->rg = $rg;
        $this->cns = $cns;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cidade = $cidade;
        $this->nomeMae = $nomeMae;
        $this->email = $email;
        $this->genero = $genero;
        $this->sexo = $sexo;
        $this->uf = $uf;
        $this->doenca = $doenca;
        $this->dataDeNascimento = $dataDeNascimento;
        $this->complemento = $complemento;
        $this->comentario = $comentario;
    }
    
    public static function create(
        string $nome,
        string $rg,
        string $cns,
        string $telefone,
        string $cep,
        string $endereco,
        string $bairro,
        string $numero,
        string $cidade,
        string $nomeMae,
        string $email,
        Genero $genero,
        Sexo $sexo,
        UF $uf,
        Doenca $doenca,
        string $dataDeNascimento,
        string $comentario,
        string $complemento
    ): Paciente {

        if (empty($nome) || strlen($nome) > 50) {
            throw new Exception("Nome do paciente inválido. Digite o nome do paciente.");
        }
    
        if (empty($rg) || !preg_match('/^\d{10}$/', $rg)) {
            throw new Exception("RG inválido. Digite o R.G. do paciente.");
        }
    
        if (empty($cns) || !preg_match('/^\d{12}$/', $cns)) {
            throw new Exception("CNS inválido. Digite o Cartão SUS do paciente.");
        }
    
        if (empty($telefone) || !preg_match('/^\+55 \(\d{2}\) \d{5}-\d{4}$/', $telefone)) {
            throw new Exception("Telefone inválido.");
        }
    
        if (empty($nomeMae) || strlen($nomeMae) > 50) {
            throw new Exception("Nome da mãe inválido. Digite o nome da mãe.");
        }
    
        if (empty($numero) || !preg_match('/^\d{1,5}$/', $numero)) {
            throw new Exception("Número do endereço inválido.");
        }
    
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("E-mail inválido.");
        }
    

        return new self(
            $nome,
            $rg,
            $cns,
            $telefone,
            $cep,
            $endereco,
            $bairro,
            $numero,
            $cidade,
            $nomeMae,
            $email,
            $genero,
            $sexo,
            $uf,
            $doenca,
            $dataDeNascimento,
            $complemento,
            $comentario
        );
    }
    
    
    
    public function getNome(): string { return $this->nome; }
    public function getRg(): string { return $this->rg; }
    public function getCns(): string { return $this->cns; }
    public function getTelefone(): string { return $this->telefone; }
    public function getCep(): string { return $this->cep; }
    public function getEndereco(): string { return $this->endereco; }
    public function getBairro(): string { return $this->bairro; }
    public function getNumero(): string { return $this->numero; }
    public function getCidade(): string { return $this->cidade; }
    public function getNomeMae(): string { return $this->nomeMae; }
    public function getEmail(): string { return $this->email; }
    public function getGenero(): Genero { return $this->genero; }
    public function getSexo(): Sexo { return $this->sexo; }
    public function getUf(): UF { return $this->uf; }
    public function getDoenca(): Doenca { return $this->doenca; }
    public function getDataDeNascimento(): string { return $this->dataDeNascimento; }
    public function getComentario(): string { return $this->comentario;}
    public function getComplemento(): string { return $this->complemento;}
}
?>
