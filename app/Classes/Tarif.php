<?php namespace LeadAssurance\Classes;

class Tarif
{
    public static function tarifProspect(){
        $tarifProspect= [
            'autos'               => [
                                            'mutualisee' => 10,
                                            'exclusive'  => 20,
                                            'label'      => 'Assurance Auto',
                                        ],
            'motos'               => [
                                            'mutualisee' => 10,
                                            'exclusive'  => 20,
                                            'label'      => 'Assurance Moto',
                                        ],
            'habitations'         => [
                                            'mutualisee' => 8,
                                            'exclusive'  => 15,
                                            'label'      => 'Assurance Habitation',
                                        ],
            'santes'              => [
                                            'mutualisee' => 15,
                                            'exclusive'  => 30,
                                            'label'      => 'Assurance Santé',
                                        ],
            'Assurance Emprunteur'         => [
                                            'mutualisee' => 20,
                                            'exclusive'  => 40,
                                            'label'      => 'Assurance Emprunteur',
                                        ],
            'Assurance loyer impayé'       =>[
                                            'mutualisee' => 15,
                                            'exclusive'  => 30,
                                            'label'      => 'Assurance loyer impayé',
                                        ] ,
            'Assurance Vie'                => [
                                            'mutualisee' => 30,
                                            'exclusive'  => 60,
                                            'label'      => 'Assurance Vie',
                                        ],
            'Assurance Chiens-chats'       => [
                                            'mutualisee' => 7,
                                            'exclusive'  => 14,
                                            'label'      => 'Assurance Chiens-chats',
                                        ],
            'Multirisque Immeuble'         => [
                                            'mutualisee' => 15,
                                            'exclusive'  => 30,
                                            'label'      => 'Multirisque Immeuble',
                                        ],
            'Assurance Obsèques-Décès'     => [
                                            'mutualisee' => 15,
                                            'exclusive'  => 30,
                                            'label'      => 'Assurance Obsèques-Décès',
                                        ],
            'Assurance Dépendance'         => [
                                            'mutualisee' => 15,
                                            'exclusive'  => 30,
                                            'label'      => 'Assurance Dépendance',
                                        ],
            'Mutuelle Collective'           => [
                                            'mutualisee' => 20,
                                            'exclusive'  => 40,
                                            'label'      => 'Mutuelle Collective',
                                        ],
            'Multirisque Professionnelle'   => [
                                            'mutualisee' => 30,
                                            'exclusive'  => 60,
                                            'label'      => 'Multirisque Professionnelle', 
                                        ],
            'RC Professionnelle'            => [
                                            'mutualisee' => 10,
                                            'exclusive'  => 20,
                                            'label'      => 'RC Professionnelle',
                                        ],
            'Flotte Automobile'             => [
                                            'mutualisee' => 15,
                                            'exclusive'  => 30,
                                            'label'      => 'Flotte Automobile',
                                        ],
            'Garantie Décennale'           => [
                                            'mutualisee' => 10,
                                            'exclusive'  => 20,
                                            'label'      => 'Garantie Décennale',
                                        ],
            'Prévoyance professionnelle'   => [
                                            'mutualisee' => 50,
                                            'exclusive'  => 100,
                                            'label'      => 'Prévoyance professionnelle',
                                        ]
        ];

        return $tarifProspect;
    }
}
