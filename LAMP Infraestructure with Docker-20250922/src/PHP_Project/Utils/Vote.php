<?php
class Vote {
    private $voterDni;
    private $voterName;
    private $artistId;

    public function __construct($voterDni = null, $voterName = null, $artistId = null) {
        $this->voterDni = $voterDni;
        $this->voterName = $voterName;
        $this->artistId = $artistId;
    }


    /**
     * Get the value of voterDni
     */
    public function getVoterDni()
    {
        return $this->voterDni;
    }

    /**
     * Set the value of voterDni
     */
    public function setVoterDni($voterDni): self
    {
        $this->voterDni = $voterDni;

        return $this;
    }

    /**
     * Get the value of voterName
     */
    public function getVoterName()
    {
        return $this->voterName;
    }

    /**
     * Set the value of voterName
     */
    public function setVoterName($voterName): self
    {
        $this->voterName = $voterName;

        return $this;
    }

    /**
     * Get the value of artistId
     */
    public function getArtistId()
    {
        return $this->artistId;
    }

    /**
     * Set the value of artistId
     */
    public function setArtistId($artistId): self
    {
        $this->artistId = $artistId;

        return $this;
    }
}
?>