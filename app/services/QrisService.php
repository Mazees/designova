<?php

class QrisService
{
    private static string $staticQris = "00020101021126610014COM.GO-JEK.WWW01189360091433847177510210G3847177510303UMI51440014ID.CO.QRIS.WWW0215ID10243243070800303UMI5204504553033605802ID5919MZ Store, Mojokerto6009MOJOKERTO61056138162070703A016304B235";

    /**
     * Calculate CRC16 checksum
     *
     * @param string $str
     * @return string
     */
    public static function crc16(string $str): string
    {
        $crc = 0xffff;
        $strlen = strlen($str);

        for ($c = 0; $c < $strlen; $c++) {
            $crc ^= ord($str[$c]) << 8;

            for ($i = 0; $i < 8; $i++) {
                if ($crc & 0x8000) {
                    $crc = (($crc << 1) ^ 0x1021) & 0xffff;
                } else {
                    $crc = ($crc << 1) & 0xffff;
                }
            }
        }

        $hex = dechex($crc & 0xffff);
        return str_pad(strtoupper($hex), 4, "0", STR_PAD_LEFT);
    }

    /**
     * Generate dynamic QRIS string based on amount
     *
     * @param int|float|string $amount
     * @return string
     */
    public static function generateDynamicQris($amount): string
    {
        if (strlen(self::$staticQris) < 4) {
            throw new Exception("Invalid static QRIS data.");
        }

        $qrisWithoutCrc = substr(self::$staticQris, 0, -4);
        
        // Change payment method from static (010211) to dynamic (010212)
        $step1 = str_replace("010211", "010212", $qrisWithoutCrc);

        // Split on country code tag "5802ID"
        $parts = explode("5802ID", $step1);

        if (count($parts) !== 2) {
            throw new Exception("QRIS data is not in the expected format (missing '5802ID').");
        }

        // Clean amount (remove leading zeros and decimals)
        $amountStr = (string) (int) $amount;

        // Amount tag (54) + length of amount string (padded to 2 digits) + amount string
        $amountTag = "54" . str_pad(strlen($amountStr), 2, "0", STR_PAD_LEFT) . $amountStr;

        $payload = $parts[0] . $amountTag . "5802ID" . $parts[1];

        $finalCrc = self::crc16($payload);

        return $payload . $finalCrc;
    }
}
