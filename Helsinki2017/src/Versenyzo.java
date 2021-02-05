
public class Versenyzo {

	private String nev;
	private String orszag;
	private double technikai;
	private double komponens;
	private double levonas;

	public Versenyzo(String nev, String orszag, double technikai, double komponens, double levonas) {
		this.nev = nev;
		this.orszag = orszag;
		this.technikai = technikai;
		this.komponens = komponens;
		this.levonas = levonas;
	}
	
	
	
	public double ÖsszPontszám() {
		return technikai + komponens - levonas;
	}

	public String getNev() {
		return nev;
	}

	public void setNev(String nev) {
		this.nev = nev;
	}

	public String getOrszag() {
		return orszag;
	}

	public void setOrszag(String orszag) {
		this.orszag = orszag;
	}

	public double getTechnikai() {
		return technikai;
	}

	public void setTechnikai(double technikai) {
		this.technikai = technikai;
	}

	public double getKomponens() {
		return komponens;
	}

	public void setKomponens(double komponens) {
		this.komponens = komponens;
	}

	public double getLevonas() {
		return levonas;
	}

	public void setLevonas(double levonas) {
		this.levonas = levonas;
	}

}
