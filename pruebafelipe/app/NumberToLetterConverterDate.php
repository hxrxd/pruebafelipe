<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumberToLetterConverterDate extends Model 
{
 
 private $UNIDADES = array(
        '',
        'uno ',
        'dos ',
        'tres ',
        'cuatro ',
        'cinco ',
        'seis ',
        'siete ',
        'ocho ',
        'nueve ',
        'diez ',
        'once ',
        'doce ',
        'trece ',
        'catorce ',
        'quince ',
        'dieciseis ',
        'diecisiete ',
        'dieciocho ',
        'diecinueve ',
        'veinte '
  );
  private $DECENAS = array(
        'veinti',
        'treinta ',
        'cuarenta ',
        'cincuenta ',
        'sesenta ',
        'setenta ',
        'ochenta ',
        'noventa ',
        'cien '
  );
  private $CENTENAS = array(
        'ciento ',
        'doscientos ',
        'trecientos ',
        'cuatrocientos ',
        'quinientos ',
        'seiscientos ',
        'setecientos ',
        'ochocientos ',
        'novecientos '
  );
  private $MONEDAS = array(
    array('country' => 'Guatemala', 'currency' => 'Q', 'singular' => 'quetzal', 'plural' => 'quetzales', 'symbol', 'Q'),
    array('country' => 'Estados Unidos', 'currency' => 'USD', 'singular' => 'DÓLAR', 'plural' => 'DÓLARES', 'symbol', 'US$'),
     array('country' => 'DPI', 'currency' => 'dpi', 'singular' => '', 'plural' => '', 'symbol', ''),
      array('country' => 'edad', 'currency' => 'edad', 'singular' => ' años', 'plural' => 'años', 'symbol', '')
  );
    private $separator = '.';
    private $decimal_mark = ',';
    private $glue = ' con ';
    /**
     * Evalua si el número contiene separadores o decimales
     * formatea y ejecuta la función conversora
     * @param $number número a convertir
     * @param $miMoneda clave de la moneda
     * @return string completo
     */
    public function to_word($number, $miMoneda = null) {
        if (strpos($number, $this->decimal_mark) === FALSE) {
          $convertedNumber = array(
            $this->convertNumber($number, $miMoneda, 'entero')
          );
        } else {
          $number = explode($this->decimal_mark, str_replace($this->separator, '', trim($number)));
          $convertedNumber = array(
            $this->convertNumber($number[0], $miMoneda, 'entero'),
            $this->convertNumber($number[1], $miMoneda, 'decimal'),
          );
        }
        return implode($this->glue, array_filter($convertedNumber));
    }
    /**
     * Convierte número a letras
     * @param $number
     * @param $miMoneda
     * @param $type tipo de dígito (entero/decimal)
     * @return $converted string convertido
     */
    private function convertNumber($number, $miMoneda = null, $type) {   
        
        $converted = '';
        if ($miMoneda !== null) {
            try {
                
                $moneda = array_filter($this->MONEDAS, function($m) use ($miMoneda) {
                    return ($m['currency'] == $miMoneda);
                });
                $moneda = array_values($moneda);
                if (count($moneda) <= 0) {
                    throw new Exception("Tipo de moneda inválido");
                    return;
                }
                ($number < 2 ? $moneda = $moneda[0]['singular'] : $moneda = $moneda[0]['plural']);
            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }
        }else{
            $moneda = '';
        }
        if (($number < 0) || ($number > 999999999)) {
            return false;
        }
        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'un millon ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%smillones ', $this->convertGroup($millones));
            }
        }
        
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'mil ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%smil ', $this->convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'uno ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', $this->convertGroup($cientos));
            }
        }
        $converted .= $moneda;
        return $converted;
    }
    /**
     * Define el tipo de representación decimal (centenas/millares/millones)
     * @param $n
     * @return $output
     */
    private function convertGroup($n) {
        $output = '';
        if ($n == '100') {
            $output = "cien ";
        } else if ($n[0] !== '0') {
            $output = $this->CENTENAS[$n[0] - 1];   
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= $this->UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sy %s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
            }
        }
        return $output;
    }
}
