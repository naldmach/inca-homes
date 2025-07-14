import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Heart, MapPin, Star } from "lucide-react";

interface PropertyCardProps {
  property: {
    id: string;
    title: string;
    location: string;
    price: number;
    rating: number;
    images: string[];
    amenities: string[];
  };
  onFavorite: (id: string) => void;
}
export function PropertyCard({ property, onFavorite }: PropertyCardProps) {
  const formattedPrice = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "Php",
  }).format(property.price);
  return (
    <Card className="group hover:shadow-lg transition-shadow duration-200">
      <CardHeader className="p-0">
        <div className="relative overflow-hidden rounded-t-lg">
          <img
            src={property.images[0]}
            alt={property.title}
            className="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-200"
          />
          <Button
            variant="ghost"
            size="icon"
            className="absolute top-2 right-2 bg-white/80 hover:bg-white"
            onClick={() => onFavorite(property.id)}
          >
            <Heart className="h-4 w-4" />
          </Button>
        </div>
      </CardHeader>
      <CardContent className="p-4">
        <div className="flex items-center gap-2 text-sm text-muted-foreground mb-1">
          <MapPin className="h-4 w-4" />
          {property.location}
        </div>
        <CardTitle className="text-lg mb-2">{property.title}</CardTitle>
        <div className="flex items-center gap-2 mb-3">
          <Star className="h-4 w-4" fill-yellow-400 text-yellow-400 />
          <span className="text-sm font-medium">{property.rating}</span>
        </div>
        <div className="flex flex-wrap gap-1 mb-3">
          {property.amenities.slice(0, 3).map((amenity) => (
            <Badge key={amenity} variant="secondary" className="text-xs">
              {amenity}
            </Badge>
          ))}
        </div>
        <div className="flex items-center justify-between">
          <span className="text-lg font-bold">{formattedPrice}/night</span>
          <Button>Book Now</Button>
        </div>
      </CardContent>
    </Card>
  );
}
