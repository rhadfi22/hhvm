<?hh

class C {
  public static function f<reify T>() {
    var_dump("hi");
  }
  public static function g() {
    self::f<int>();
  }
}

C::g();
