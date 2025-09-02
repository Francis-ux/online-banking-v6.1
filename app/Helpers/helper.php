<?php

function currency($currency, $type = 'symbol')
{

    $explodeCurrency = explode('-', $currency);

    switch ($type) {
        case 'name':
            return $explodeCurrency[0];
            break;
        case 'code':
            return $explodeCurrency[1];
        case 'symbol':
            return $explodeCurrency[2];
        default:
            return $explodeCurrency[2];
            break;
    }
}

function formatAmount($amount)
{
    return number_format($amount, 2);
}

function generateReferenceId()
{
    return random_int(100000000, 999999999);
}

function getAccountNumber()
{
    $fixedPrefix = "300";

    // Generate random 7-digit suffix
    $suffix = rand(0, 9999999);
    $suffix = str_pad($suffix, 7, '0', STR_PAD_LEFT);

    // Concatenate prefix and suffix to form the account number
    $accountNumber = $fixedPrefix . $suffix;

    return $accountNumber;
}

function getRandomNumber($length = 2)
{
    // Define the characters to be used in the random number
    $characters = '0123456789';
    // Initialize an empty string to store the random number
    $randomNumber = '';
    // Loop to generate each digit of the random number
    for ($i = 0; $i < $length; $i++) {
        // Append a random digit to the random number
        $randomNumber .= $characters[rand(0, strlen($characters) - 1)];
    }
    // Return the generated random number
    return $randomNumber;
}

function generateTransferCode($length, $isAlphanumeric = true)
{
    // Define the character set based on the code type
    $characters = $isAlphanumeric ? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' : '0123456789';

    // Define an empty string to store the generated code
    $code = '';

    // Calculate the length of the character set
    $charLength = strlen($characters);

    // Generate the code by selecting random characters from the character set
    for ($i = 0; $i < $length; $i++) {
        // Select a random index within the character set
        $randomIndex = rand(0, $charLength - 1);

        // Get the character at the random index from the character set
        $randomCharacter = $characters[$randomIndex];

        // Append the random character to the code string
        $code .= $randomCharacter;
    }

    return $code;
}

function limitText($text, $limit = 20)
{
    return str()->limit($text, $limit);
}
