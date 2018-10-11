<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="reponse")
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormResponses", inversedBy="reponse")
     */
    private $formResponses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getFormResponses(): ?FormResponses
    {
        return $this->formResponses;
    }

    public function setFormResponses(?FormResponses $formResponses): self
    {
        $this->formResponses = $formResponses;

        return $this;
    }
}
