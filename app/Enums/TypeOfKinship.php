<?php

namespace App\Enums;

enum TypeOfKinship: string
{
    case Padre = 'father';
    case Madre = 'mother';
    case Hijo = 'son';
    case Hija = 'daughter';
    case Hermano = 'brother';
    case Hermana = 'sister';
    case Abuelo = 'grandfather';
    case Abuela = 'grandmother';
    case Nieto = 'grandson';
    case Nieta = 'granddaughter';
    case Tio = 'uncle';
    case Tia = 'aunt';
    case Sobrino = 'nephew';
    case Sobrina = 'niece';
    case PrimoPrima = 'cousin';
    case EsposoMarido = 'husband';
    case EsposaMujer = 'wife';
    case Suegro = 'father-in-law';
    case Suegra = 'mother-in-law';
    case Yerno = 'son-in-law';
    case Nuera = 'daughter-in-law';
    case Cuñado = 'brother-in-law';
    case Cuñada = 'sister-in-law';
    case Padrastro = 'stepfather';
    case Madrastra = 'stepmother';
    case Hijastro = 'stepson';
    case Hijastra = 'stepdaughter';
    case MedioHermano = 'half-brother';
    case MediaHermana = 'half-sister';
    case Padrino = 'godfather';
    case Madrina = 'godmother';
}
