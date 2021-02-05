import java.time.LocalDate;

public class Eu {

	private String Orszag_nev;
	private LocalDate Csatlakozas_eve;
	
	public Eu(String orszag_nev, LocalDate csatlakozas_eve) {
		super();
		Orszag_nev = orszag_nev;
		Csatlakozas_eve = csatlakozas_eve;
	}
	public String getOrszag_nev() {
		return Orszag_nev;
	}
	public void setOrszag_nev(String orszag_nev) {
		Orszag_nev = orszag_nev;
	}
	public LocalDate getCsatlakozas_eve() {
		return Csatlakozas_eve;
	}
	public void setCsatlakozas_eve(LocalDate csatlakozas_eve) {
		Csatlakozas_eve = csatlakozas_eve;
	}
	@Override
	public String toString() {
		return "Eu [Orszag_nev=" + Orszag_nev + ", Csatlakozas_eve=" + Csatlakozas_eve + "]";
	}
	
	
	
	
	
	

}
